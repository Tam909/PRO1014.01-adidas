@extends('user.layoutUser') {{-- Đảm bảo layout này tồn tại và được cấu hình --}}

@section('title', 'Giới Thiệu Về Chúng Tôi')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="text-center mb-4">Giới Thiệu Về Chúng Tôi</h1>
                <hr class="mb-5">

                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <h3>Sứ Mệnh Của Chúng Tôi</h3>
                        <p>Chào mừng bạn đến với Adidas! Chúng tôi cam kết mang đến những sản phẩm chất lượng cao nhất, đa
                            dạng về mẫu mã và luôn cập nhật xu hướng mới nhất để đáp ứng mọi nhu cầu của khách hàng. Sứ mệnh
                            của chúng tôi là không chỉ cung cấp sản phẩm mà còn tạo ra trải nghiệm mua sắm tuyệt vời, tiện
                            lợi và đáng tin cậy.</p>
                    </div>
                </div>

                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <h3>Giá Trị Cốt Lõi</h3>
                        <ul>
                            <li><strong>Chất lượng hàng đầu:</strong> Performance (Hiệu suất): Adidas cam kết tạo ra những
                                sản phẩm thể thao và trang phục có hiệu suất tốt nhất trên thị trường.</li>
                            <li><strong>Khách hàng là trọng tâm:</strong> Passion (Đam mê): Công ty duy trì niềm đam mê mạnh
                                mẽ với thể thao. Adidas không chỉ là một tập đoàn mà là một đội ngũ những cá nhân cùng chia
                                sẻ niềm đam mê, thường xuyên tuyển dụng những người có tinh thần thể thao.</li>
                            <li><strong>Đổi mới không ngừng:</strong> ntegrity (Chính trực): Adidas cam kết cải thiện cuộc
                                sống con người thông qua thể thao một cách sâu sắc.</li>
                            <li><strong>Trách nhiệm xã hội:</strong> Diversity (Đa dạng): Adidas đề cao sự đa dạng dưới mọi
                                hình thức. Họ tạo ra nhiều loại sản phẩm phù hợp với mọi người, bất kể kích thước, tuổi tác,
                                giới tính hay kỹ năng thể thao.</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <h3>Lịch Sử Hình Thành</h3>
                        <p> <strong>Khởi nguồn (1920-1947) </strong> : Adolf "Adi" Dassler bắt đầu sản xuất giày thể thao thủ
                            công ở Herzogenaurach, Đức.
                            Cùng anh trai Rudolf, ông thành lập "Dassler Brothers Shoe Factory" và sớm nổi tiếng nhờ các vận
                            động viên Olympic sử dụng giày của họ (điển hình là Jesse Owens năm 1936).
                        </p>
                        <p>
                            <strong>Chia ly (1948-1949) </strong> : Mâu thuẫn cá nhân và kinh doanh dẫn đến việc hai anh em
                            chia tách công ty.
                        </p>
                        <p>
                            <strong>Phát triển & Mở rộng (1950s-1980s)</strong> : Adidas tiếp tục gặt hái thành công lớn
                            trong các sự kiện thể thao (World Cup 1954 với giày đinh tháo rời) và mở rộng sang quần áo, dụng
                            cụ thể thao, trở thành nhà cung cấp hàng đầu.
                        </p>
                        <p> <strong>Tái cấu trúc & Đổi mới (1990s-Nay)</strong> : Sau giai đoạn khó khăn, Robert Louis-Dreyfus tái cấu
                            trúc công ty vào thập niên 90. Adidas tiếp tục đổi mới công nghệ (Boost, Primeknit), mở rộng
                            dòng sản phẩm thời trang (Originals) và hợp tác với các nhân vật nổi tiếng để duy trì vị thế dẫn
                            đầu trong ngành thể thao toàn cầu. </p>
                    </div>

                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <h3>Đội Ngũ Của Chúng Tôi</h3>
                        <p>Tại Adidas, chúng tôi tin rằng thành công không chỉ đến từ những sản phẩm đột phá hay chiến lược marketing tài tình, mà còn đến từ sức mạnh của một đội ngũ toàn cầu đầy đam mê, tài năng và đa dạng. Đội ngũ của chúng tôi là trái tim và linh hồn của thương hiệu, là những người biến tầm nhìn "Through sport, we have the power to change lives" thành hiện thực mỗi ngày.</p>
                        <p class="text-center mt-4">Cảm ơn bạn đã tin tưởng và lựa chọn <strong> Adidas!</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
