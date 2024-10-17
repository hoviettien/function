<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            height: 320px;
            width: 500px;
            background-color: rgb(250, 195, 243);
        }
        .div1 {
            height: 15%;
            width: 100%;
            text-align: center;
            line-height: 45px;
        }
        .div2_1, .div2_2, .div2_3, .div2_4 {
            height: 10%;
            width: 100%;
            display: flex;
            text-align: left;
            line-height: 30px;
            margin-bottom: 10px;
        }
        .left {
            height: 100%;
            width: 20%;
            background-color: rgb(250, 195, 243);
            margin-left: 10px;
        }
        .right {
            height: 100%;
            width: 70%;
            background-color: white;
        }
        input, select {
            border: none;
        }
        .div3 {
            margin-top: 25px;
            height: 10%;
            width: 100%;
            font-size: 25px;
        }
        .div4 {
            height: 10%;
            width: 100%;
            margin-top: 30px;
            display: flex;
        }
        .con1, .con2 {
            height: 100%;
            width: 50%;
            text-align: center;
        }
        #result {
            height: 35px;
            width: 300px;
            background-color: yellow;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="div1">BẢNG ĐIỂM CỦA EM</div>
            <div class="div2_1">
                <div class="left">Semester1:</div>
                <div class="right">
                    <input type="number" name="text1" required>
                </div>
            </div>
            <div class="div2_2">
                <div class="left">Semester2:</div>
                <div class="right">
                    <input type="number" name="text2" required>
                </div>
            </div>
            <div class="div2_3">
                <div class="left">Year:</div>
                <div class="right">
                    <select name="year" required>
                        <option value="0">Mời chọn</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="div2_4">
                <div class="left">Summarise:</div>
                <input class="right" name="result" id="kq" readonly />
            </div>
            <div class="div3">
                <div id="result"></div>
            </div>
            <div class="div4">
                <div class="con1">
                    <button type="submit">OK</button>
                </div>
                <div class="con2"><button type="reset">Cancel</button></div>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $semester1 = isset($_POST['text1']) ? (int)$_POST['text1'] : 0;
        $semester2 = isset($_POST['text2']) ? (int)$_POST['text2'] : 0;
        $year = isset($_POST['year']) ? (int)$_POST['year'] : 0;

        $kq = 0;

        // Tính toán kết quả dựa trên năm học
        switch ($year) {
            case 1:
                $kq = ($semester1 + ($semester2 * 2)) / 3;
                break;
            case 2:
            case 3:
                $kq = (($semester1 * 2) + ($semester2 * 3)) / 5;
                break;
            default:
                echo "Vui lòng chọn năm học hợp lệ.";
                exit;
        }

        // Đánh giá kết quả
        $resultText = '';
        if ($kq >= 9) {
            $resultText = "Học sinh giỏi";
        } elseif ($kq >= 7 && $kq < 9) {
            $resultText = "Học sinh khá";
        } elseif ($kq >= 5 && $kq < 7) {
            $resultText = "Học sinh trung bình";
        } else {
            $resultText = "Học sinh yếu";
        }

        // Truyền dữ liệu tới JavaScript
        echo "<script>
            document.getElementById('kq').value = '" . round($kq, 2) . "';
            document.getElementById('result').innerHTML = '" . $resultText . "';
        </script>";
    }
    ?>
</body>
</html>
