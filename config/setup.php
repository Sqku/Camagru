<?php
require(__DIR__.'/database.php');
if (!isset($DB_DSN) || !isset($DB_USER) || !isset($DB_PASSWORD) || empty($DB_DSN) || empty($DB_USER))
{
    die('Error : database.php is not valid.');
}
$tmp = explode(':', $DB_DSN);
$tmp = explode(';', $tmp[1]);
$dsn = 'mysql:';
foreach ($tmp as $r)
{
    if (strstr($r, 'dbname=') === FALSE)
        $dsn .= $r;
}
try {
    $pdo = new \PDO($dsn, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}
catch (\PDOException $e)
{
    echo 'Error PDO: '.$e->getMessage();
    die();
}
echo 'Are you sure you want to do this ?! (yes/no)  ';
flush();
ob_flush();
$confirmation  =  trim( fgets( STDIN ) );
if ($confirmation !== 'yes' && $confirmation !== 'y')
    exit (0);
echo 'Step 1 : Clear upload images files.'.PHP_EOL;
$uploads_dir = dirname(__DIR__).'/web/img/uploads/';
$uploads_files = glob($uploads_dir.'*.png');
foreach ($uploads_files as $file)
    if (is_file($file))
        unlink($file);
echo 'Step 1 : Done'.PHP_EOL;
echo 'Step 2 : Database installation.'.PHP_EOL;
$schema = explode(';', $DB_DSN);
$schema = explode('=', $schema[0]);
$schema = $schema[1];


$sql = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


DROP SCHEMA IF EXISTS `camagru` ;


CREATE SCHEMA IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 ;
USE `camagru` ;


DROP TABLE IF EXISTS `camagru`.`users` ;

CREATE TABLE IF NOT EXISTS `camagru`.`users` (
`id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `lvl` INT NULL,
  `mdp` VARCHAR(255) NULL,
  `date_inscription` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` TINYINT(1) NULL,
  `cle` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;



DROP TABLE IF EXISTS `camagru`.`images` ;

CREATE TABLE IF NOT EXISTS `camagru`.`images` (
`id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` INT NOT NULL,
  `like_count` INT NULL DEFAULT 0,
  `dislike_count` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_images_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_images_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



DROP TABLE IF EXISTS `camagru`.`commentaires` ;

CREATE TABLE IF NOT EXISTS `camagru`.`commentaires` (
`id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `commentaire` LONGTEXT NULL,
  `users_id` INT NOT NULL,
  `images_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_commentaires_users1_idx` (`users_id` ASC),
  INDEX `fk_commentaires_images1_idx` (`images_id` ASC),
  CONSTRAINT `fk_commentaires_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentaires_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `camagru`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



DROP TABLE IF EXISTS `camagru`.`likes` ;

CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
`id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `images_id` INT NOT NULL,
  `vote` INT NULL DEFAULT 0, 
  INDEX `fk_likes_users1_idx` (`users_id` ASC),
  INDEX `fk_likes_images1_idx` (`images_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_likes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `camagru`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";

$sql = explode(';', $sql);
            $error = FALSE;
            foreach ($sql as $line)
            {
                $line = trim($line);
                if (!empty($line))
                {
                    try
                    {
                        $pdo->query($line);
                    }
                    catch (\PDOException $e)
                    {
                        echo 'Error sql : '. $e->getMessage().PHP_EOL;
                        $error = TRUE;
                    }
                }
            }
            if ($error)
                echo 'Step 2 : Error, please retry.'.PHP_EOL;
            else
                echo 'Step 2 : DONE'.PHP_EOL;

?>