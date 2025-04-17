<div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner rounded shadow">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="height: 400px; background: url('{{ asset('https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/11/background-hinh-nen-powerpoint-de-thuong-giao-duc-4-768x432.jpg') }}') center/cover no-repeat;">
            <div class="d-flex h-100 align-items-center justify-content-center text-white bg-dark bg-opacity-50">
                <div class="text-center">
                    <h1 class="display-5 fw-bold">Chào mừng đến với PetShop</h1>
                    <p class="lead">Nơi bạn tìm thấy người bạn nhỏ đáng yêu nhất 🐾</p>
                    <a href="{{ route('client.products.list') }}" class="btn btn-primary px-4 py-2 mt-3">Khám phá ngay</a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="height: 400px; background: url('{{ asset('https://th.bing.com/th/id/OIP.lJeFflwrV4rnre7nBPyfIgHaEK?w=1600&h=899&rs=1&pid=ImgDetMain') }}') center/cover no-repeat;">
            <div class="d-flex h-100 align-items-center justify-content-center text-white bg-dark bg-opacity-50">
                <div class="text-center">
                    <h1 class="display-5 fw-bold">Ưu đãi cực hot 🎁</h1>
                    <p class="lead">Giảm giá đến 30% cho thú cưng đầu tiên của bạn!</p>
                    <a href="{{ route('client.products.list') }}" class="btn btn-warning px-4 py-2 mt-3">Mua ngay</a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="height: 400px; background: url('{{ asset('https://th.bing.com/th/id/OIP.5AGWyblKADy9jjVl3hiICgHaDO?w=1146&h=500&rs=1&pid=ImgDetMain') }}') center/cover no-repeat;">
            <div class="d-flex h-100 align-items-center justify-content-center text-white bg-dark bg-opacity-50">
                <div class="text-center">
                    <h1 class="display-5 fw-bold">Dịch vụ chăm sóc tận tâm</h1>
                    <p class="lead">Tư vấn - tiêm phòng - huấn luyện từ A đến Z</p>
                    <a href="#" class="btn btn-light px-4 py-2 mt-3">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
