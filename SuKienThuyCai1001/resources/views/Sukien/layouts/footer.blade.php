<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <footer style="background: url('/Uploads/images/banner/footer-bg.jpg') center center/cover no-repeat #666;">
        <div class="container">
            <div class="tbl" style="display: flex; flex-wrap: wrap; justify-content: space-between; padding: 40px 0;">

                <!-- Thông tin liên hệ -->
                <div class="tbl-cell" style="flex: 1 1 50%; min-width: 300px; color: white;">
                    <h2 style="font-weight: bold;">Trung tâm Tổ chức sự kiện Thúy Cải</h2>
                    <table class="table-footer" style="width: 100%; margin-top: 20px; color: white;">
                        <tbody>
                            <tr>
                                <td style="width: 1%; padding-right: 10px; text-align: center;"><i
                                        class="fa fa-map-marker"></i></td>
                                <td colspan="3">126 CHU VĂN AN - P. QUANG TRUNG Thai Binh, Vietnam</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><i class="fa fa-phone"></i></td>
                                <td>(+84) 981061116 / (+84) 913211619</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><i class="fa fa-globe"></i></td>
                                <td colspan="3"><a href="http://www.ncc.gov.vn" style="color: white;">www.thuycai.vn</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><i class="fa fa-envelope"></i></td>
                                <td colspan="3"><a href="mailto:ncc.hanoi.vietnam@gmail.com"
                                        style="color: white;">trungtamtochucsukienthuycai@gmail.com</a></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><i class="fa fa-facebook"></i></td>
                                <td colspan="3">
                                    <a href="https://www.facebook.com/profile.php?id=100063709924481" target="_blank"
                                        style="color: white;">
                                        https://www.facebook.com/profile.php?id=100063709924481
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Newsletter -->
                <div class="tbl-cell" style="flex: 1 1 40%; min-width: 300px; color: white;">
                    <h2 style="font-weight: bold;">Newsletter</h2>
                    <form action="/Ajax/Home/RegisterReturnEmailProcess" id="dwfrm_newsletter" method="post" novalidate
                        style="margin-top: 20px; display: flex;">
                        <input type="email" id="dwfrm_newsletter_email" name="dwfrm_newsletter_email"
                            class="form-control" placeholder="Email"
                            style="flex: 1; padding: 10px; border-radius: 5px 0 0 5px; border: none; outline: none;">
                        <button type="submit" id="btn-send-letter1"
                            style="padding: 0 15px; background-color: #007bff; color: white; border: none; border-radius: 0 5px 5px 0;">
                            <i class="fa fa-long-arrow-right"></i>
                        </button>
                    </form>

                    <div class="mess-email-letter error-letter" style="margin-top: 10px;"></div>
                    <div class="mess-email-letter sucess-letter" style="margin-top: 10px;">Đăng ký thành công, xin cảm
                        ơn!</div>

                    <!-- Social Icons -->
                    <ul class="socials list-unstyled list-inline" style="margin-top: 20px; display: flex; gap: 15px;">
                        <li><a href="https://www.facebook.com/TTHNQG/" title="Facebook" class="fa fa-facebook"
                                style="color: #aaccff;"></a></li>
                        <li><a href="#" title="Twitter" class="fa fa-twitter" style="color: #aaccff;"></a></li>
                        <li><a href="#" title="Google" class="fa fa-google-plus" style="color: #aaccff;"></a></li>
                        <li><a href="#" title="YouTube" class="fa fa-youtube-play" style="color: #aaccff;"></a></li>
                        <li><a href="#" title="LinkedIn" class="fa fa-linkedin" style="color: #aaccff;"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div id="copyright">
        <div style="text-align: center">© 2025 Bản quyền thuộc về Trung tổ chức sự kiện Thúy Cải. </div>
    </div>
</body>

</html>