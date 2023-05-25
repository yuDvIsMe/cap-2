<?php require_once('inc/subnav.php') ?>
<div class="about mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=home">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=quizz">Trắc nghiệm GPLX</a>
            </li>
        </ul>
        <div class="content">
            <h2 class="mb-4" style="display: flex; justify-content: center;">Chào mừng bạn đến với luyện tập trắc nghiệm thi bằng lái A1 của TVMS</h2>
            <p>
                Cấu trúc bộ đề thi sát hạch giấy phép lái xe hạng A1 sẽ bao gồm <strong> 20 câu hỏi </strong>, mỗi câu hỏi chỉ có <strong> duy nhất 1 đáp trả lời đúng </strong> phản ánh đúng bản chất của thi trắc nghiệm. 
                Bạn cần trả lời đúng <strong> 16/ 20 câu hỏi </strong> để có thể vượt qua phần thi lý thuyết trước khi bước vào bài thi thực hành.
                Hệ thống của chúng tôi sẽ lựa chọn ngẫu nhiên 20 câu hỏi trong bộ đề và các bạn sẽ biết đáp án từng câu hỏi của mình là đúng hay sai ngay sau khi chọn. 
                Ý nghĩa của việc này là sẽ giúp các bạn nhận ra ngay lỗi sai và câu hỏi mà các bạn chưa nhớ rõ để có thể chú ý hơn.
            </p>
            <p>
                Hãy chắc chắn là các bạn sẽ thực hiện bài <a href="<?php echo base_url ?>?page=practice-try"><strong> ôn tập </strong></a> này nhiều lần để có thể nhớ rõ toàn bộ câu hỏi trong bộ đề thi thử của chúng tôi. Đây sẽ là hành trang 
                giúp các bạn có thể tự tin hơn trước khi bước vào phòng thi. Hãy cố gắng ôn tập thật nhiều nhé.
            </p>
            <p>
                Chúc quý học viên ôn tập và có một kì thi tốt, nếu có khó khăn gì trong quá trình trải nghiệm, hãy để lại bình luận để chúng tôi có thể hỗ trợ bạn !
            </p>
            <div class="mt-5" style="display: flex; justify-content: center;;">
                
                <a href="<?php echo base_url ?>?page=practice-try" class="btn-login">Thử nào !!!</a>
            </div>
        </div>
    </div>
</div>
<style>
    .content p{
        color: #000;
    }
    .content p strong{
        color: red;
    }
</style>