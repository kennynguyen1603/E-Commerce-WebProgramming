<?php
class DB_Connection
{
    private const SERVERNAME = "localhost";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const DATABASENAME = "ecommerce";
    private const PORT = 3308;
    private $connection;

    // Kết nối tới database và lưu kết nối
    public function connect()
    {
        if ($this->connection === null) { // Kiểm tra nếu kết nối chưa được khởi tạo
            try {
                $this->connection = new PDO(
                    "mysql:host=" . self::SERVERNAME . ";port=" . self::PORT . ";dbname=" . self::DATABASENAME,
                    self::USERNAME,
                    self::PASSWORD
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $exception) {
                echo json_encode(['success' => false, 'error' => 'Kết nối thất bại: ' . $exception->getMessage()]);
                exit();
            }
        }
        return $this->connection;
    }

    // Hàm lấy ID của bản ghi vừa chèn vào
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    // Hàm tổng quát cho CREATE, UPDATE, DELETE
    public function query($query, $params)
    {
        try {
            $statement = $this->connect()->prepare($query);
            return $statement->execute($params);
        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'error' => $exception->getMessage(), 'line' => $exception->getLine()]);
            exit();
        }
    }


    # Lấy tất cả dữ liệu
    public function get($query, $params = null)
    {
        try {
            // Kết nối tới database
            $connection = $this->connect();

            // Chuẩn bị câu lệnh SQL với tham số
            $statement = $connection->prepare($query);

            // Thực thi câu lệnh SQL với tham số
            if ($params === null) {
                $statement->execute();
            } else {
                $statement->execute($params);
            }

            // Lấy tất cả dữ liệu từ câu lệnh SQL
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'error' => $exception->getMessage(), 'line' => $exception->getLine()]);
            exit();
        }
    }

    # Lấy một dữ liệu
    public function get_one($query, $params = null)
    {
        try {
            // Kết nối tới database
            $connection = $this->connect();

            // Chuẩn bị câu lệnh SQL với tham số
            $statement = $connection->prepare($query);

            // Thực thi câu lệnh SQL với tham số
            if ($params === null) {
                $statement->execute();
            } else {
                $statement->execute($params);
            }

            // Lấy một dữ liệu từ câu lệnh SQL
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'error' => $exception->getMessage(), 'line' => $exception->getLine()]);
            exit();
        }
    }

    # Lấy số lượng dữ liệu
    public function count($query, $params = null)
    {
        try {
            // Kết nối tới database
            $connection = $this->connect();

            // Chuẩn bị câu lệnh SQL với tham số
            $statement = $connection->prepare($query);

            // Thực thi câu lệnh SQL với tham số
            if ($params === null) {
                $statement->execute();
            } else {
                $statement->execute($params);
            }

            // Lấy số lượng dữ liệu từ câu lệnh SQL
            $data = $statement->rowCount();
            return $data;
        } catch (Exception $exception) {
            echo json_encode(['success' => false, 'error' => $exception->getMessage(), 'line' => $exception->getLine()]);
            exit();
        }
    }
}
