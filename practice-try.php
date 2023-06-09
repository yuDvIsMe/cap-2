<?php require_once('inc/subnav.php') ?>

<!-- Contact Start -->
<div class="single mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=home">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=quizz">Trắc nghiệm GPLX</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="#">Luyện thi</a>
            </li>
        </ul>
        <div class="content">
            <h1 class="text-center mb-5">Luyện tập câu hỏi trắc nghiệm thi bằng lái xe A1</h1>
            <?php $questionNumber = 1;
            $sql = $conn->query("SELECT DISTINCT * FROM question ORDER BY RAND() LIMIT 20");
            $result = $sql->num_rows;

            // Kiểm tra số lượng câu hỏi
            if ($result > 0) {
                // Hiển thị câu hỏi và đáp án
                while ($row = $sql->fetch_assoc()) {
                    echo "<div class='card mb-4'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $questionNumber . ". " . $row["content"] . "</h5>";
                    if (!empty($row['content_img'])) : ?>
                        <div class="text-center mb-3">
                            <img style="max-width:50%;height:50%;" src="<?php echo $row['content_img']; ?>" alt="Question Image" class="img-fluid">
                        </div>
            <?php endif;
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='answer[" . $row["id"] . "]' id='answer-" . $row["id"] . "-a' value='a' onclick='checkAnswer(" . $row["id"] . ", \"a\", " . $row["correct_option"] . ")'>";
                    echo "<label class='form-check-label' for='answer-" . $row["id"] . "-a'>" . $row["option_A"] . "</label>";
                    echo "</div>";
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='answer[" . $row["id"] . "]' id='answer-" . $row["id"] . "-b' value='b' onclick='checkAnswer(" . $row["id"] . ", \"b\", " . $row["correct_option"] . ")'>";
                    echo "<label class='form-check-label' for='answer-" . $row["id"] . "-b'>" . $row["option_B"] . "</label>";
                    echo "</div>";
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='answer[" . $row["id"] . "]' id='answer-" . $row["id"] . "-c' value='c' onclick='checkAnswer(" . $row["id"] . ", \"c\", " . $row["correct_option"] . ")'>";
                    echo "<label class='form-check-label' for='answer-" . $row["id"] . "-c'>" . $row["option_C"] . "</label>";
                    echo "</div>";
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='answer[" . $row["id"] . "]' id='answer-" . $row["id"] . "-d' value='d' onclick='checkAnswer(" . $row["id"] . ", \"d\", " . $row["correct_option"] . ")'>";
                    echo "<label class='form-check-label' for='answer-" . $row["id"] . "-d'>" . $row["option_D"] . "</label>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $questionNumber++;
                }
            }
            ?>
            <button class="btn btn-primary" onclick="reloadPage()">Thử lại</button>
        </div>
        
    </div>
</div>
<script>
    var a = "a";
    var b = "b";
    var c = "c";
    var d = "d";

    function checkAnswer(questionId, selectedOption, correctOption) {
        // Xóa lớp màu nền của đáp án đã chọn trước đó 
        $('input[name="answer[' + questionId + ']"]').parent().removeClass('text-success text-danger');
        // Xóa icon đã chọn trước đó và các icon cùng cấp
        $('input[name="answer[' + questionId + ']"]').siblings('i').remove();
        // Kiểm tra đáp án đã chọn có đúng không 
        if (selectedOption === correctOption) {
            // Nếu đáp án đúng, áp dụng lớp màu nền xanh 
            $('input[name="answer[' + questionId + ']"][value="' + selectedOption + '"]').parent().addClass('text-success');
            // Thêm icon tick xanh sau câu đúng
            $('input[name="answer[' + questionId + ']"][value="' + selectedOption + '"]').parent().append('  <i class="fas fa-check"></i>');
        } else {
            // Nếu đáp án sai, áp dụng lớp màu nền đỏ 
            $('input[name="answer[' + questionId + ']"][value="' + selectedOption + '"]').parent().addClass('text-danger');
            // Đánh dấu đáp án đúng bằng lớp màu nền xanh 
            $('input[name="answer[' + questionId + ']"][value="' + correctOption + '"]').parent().addClass('text-success').append('  <i class="fas fa-check"></i>');
            // Thêm icon x màu đỏ sau câu sai
            $('input[name="answer[' + questionId + ']"][value="' + selectedOption + '"]').parent().append('  <i class="fas fa-times"></i>');
        }
    }

    function reloadPage() {
        location.reload();
    }
</script>