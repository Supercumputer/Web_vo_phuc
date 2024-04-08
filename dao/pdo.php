<?php
    function pdo_get_connection(){
        $host = "127.0.0.1";
        $username ="root";
        $password ="";
        $dbname ="database_da1";
        try{
            //chuỗi kết nối
            $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
            //set thuộc tính ngoại lệ
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }

    function pdo_execute($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
        }catch(PDOException $e){
            throw $e;
        }finally{
            unset($conn);
        }
    }

    function pdo_query($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        }catch(PDOException $e){
            throw $e;
        }finally{
            unset($conn);
        }
    }

    function pdo_query_one($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }

    function pdo_query_value($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }

?>