<?php

class Vote
{
    private $like ;
    private $dislike;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function like($id, $user_id)
    {
        $this->like = 1;

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

    }

    public function dislike($id, $user_id)
    {
        $this->dislike = -1;

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
    }
}

?>