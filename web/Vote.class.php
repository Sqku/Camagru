<?php

class Vote
{
    private $pdo;
    private $like;
    private $dislike;
    private $former_vote;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function like($id, $user_id)
    {
        $this->like = 1;

        $query1=$this->pdo->prepare("SELECT id, vote FROM likes WHERE images_id=? AND users_id=?");
        $query1->execute(array($id, $user_id));
        $data1=$query1->fetch();

        if($data1)
        {
            if ($data1['vote'] == 1)
                return true;

            $this->former_vote = $data1;

            $query2=$this->pdo->prepare("UPDATE likes SET vote = 1 WHERE id = {$data1['id']}");
            $query2->execute();

            $sql_part = "";

            if($this->former_vote)
            {
                $sql_part = ", dislike_count = dislike_count - 1";
            }

            $query=$this->pdo->prepare("UPDATE images SET like_count = like_count + 1 $sql_part WHERE id = $id");
            $query->execute();

            return true;
        }

        try
        {
            $query=$this->pdo->prepare('INSERT INTO likes (users_id, images_id, vote) VALUES (:users_id, :images_id, :vote)');
            $query->bindValue(':users_id', $user_id, PDO::PARAM_STR);
            $query->bindValue(':images_id', $id, PDO::PARAM_INT);
            $query->bindValue(':vote', $this->like, PDO::PARAM_INT);
            $query->execute();
        }
        catch (PDOException $e)
        {
            echo 'Pdo error: ' . $e->getMessage();
            die();
        }

        $sql_part = "";

        if($this->former_vote)
        {
            $sql_part = ", dislike_count = dislike_count - 1";
        }

        $query=$this->pdo->prepare("UPDATE images SET like_count = like_count + 1 $sql_part WHERE id = $id");
        $query->execute();

    }

    public function dislike($id, $user_id)
    {
        $this->dislike = -1;

        $query1=$this->pdo->prepare("SELECT id, vote FROM likes WHERE images_id=? AND users_id=?");
        $query1->execute(array($id, $user_id));
        $data1=$query1->fetch();

        if($data1)
        {
            if ($data1['vote'] == -1)
                return true;

            $this->former_vote = $data1;

            $query2=$this->pdo->prepare("UPDATE likes SET vote = -1 WHERE id = {$data1['id']}");
            $query2->execute();

            $sql_part = "";

            if($this->former_vote)
            {
                $sql_part = ", like_count = like_count - 1";
            }

            $query=$this->pdo->prepare("UPDATE images SET dislike_count = dislike_count + 1 $sql_part WHERE id = $id");
            $query->execute();

            return true;

        }

        try
        {
            $query=$this->pdo->prepare('INSERT INTO likes (users_id, images_id, vote) VALUES (:users_id, :images_id, :vote)');
            $query->bindValue(':users_id', $user_id, PDO::PARAM_STR);
            $query->bindValue(':images_id', $id, PDO::PARAM_INT);
            $query->bindValue(':vote', $this->dislike, PDO::PARAM_INT);
            $query->execute();
        }
        catch (PDOException $e)
        {
            echo 'Pdo error: ' . $e->getMessage();
            die();
        }

        $sql_part = "";

        if($this->former_vote)
        {
            $sql_part = ", like_count = like_count - 1";
        }

        $query=$this->pdo->prepare("UPDATE images SET dislike_count = dislike_count + 1 $sql_part WHERE id = $id");
        $query->execute();

    }

    public function updateCount($id)
    {
        $query=$this->pdo->prepare("SELECT COUNT(id) as count, vote FROM likes WHERE images_id = ? GROUP BY vote ");
        $query->execute(array($id));
        $data=$query->fetchAll(PDO::FETCH_ASSOC);

        $counts = ['-1' => 0, '1' => 0];

        foreach($data as $vote)
        {
            $counts[$vote->vote] = $vote->count;
        }

        $query = $this->pdo-prepare("UPDATE images SET like_count = {$counts['1']}, dislike_count = {$counts['-1']} WHERE id = $id");
        $query->execute();

        return true;
    }

    public static function getClass($vote)
    {
        if($vote)
        {
            return $vote->vote == 1 ? 'is-liked' : 'is-disliked';
        }
        return null;
    }


}

?>