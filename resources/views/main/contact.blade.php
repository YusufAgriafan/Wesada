<x-layout.layout-master>
    <x-slot:title>
        Wesada - Hubungi Kami
    </x-slot>
        
    <x-slot:header>
        <x-layout.header-main breadcrumb="Hubungi">
            Hubungi Kami
        </x-layout.header-main>
    </x-slot>

    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary mb-4">Hubungi Kami</h4>
                <h1 class="display-5 mb-4">Dapatkan Bantuan dan Informasi Seputar Wesada</h1>
                <p class="mb-0">Kami selalu siap membantumu! Jika kamu memiliki pertanyaan seputar Wesada, ide bisnis, manajemen keuangan, atau bagaimana menggunakan platform kami, jangan ragu untuk menghubungi kami. Tim kami akan dengan senang hati memberikan panduan yang kamu butuhkan untuk memulai atau mengembangkan bisnismu.

                </p>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-2">Formulir Kontak</h2>
                    <p class="mb-4">Formulir kontak ini tersedia untuk membantu Anda terhubung dengan kami. Isi formulir di bawah ini, dan tim kami akan merespon secepat mungkin. 
                        {{-- <a class="text-primary fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a>. --}}
                    </p>
                    
                    @if(session()->has('success') || session()->has('error'))
                        <div class="alert alert-{{ session()->has('success') ? "success" : "danger" }}">
                            {{ session()->has('success') ? session('success') : session('error') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.send') }}" method="POST" onSubmit="return valid_datas(this);" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama" placeholder="Namamu" name="nama" required>
                                    <label for="nama">Nama</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Emailmu" name="email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="phone" class="form-control" id="nomor" placeholder="Nomor Teleponmu" name="nomor">
                                    <label for="nomor">Nomor Telepon</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subjek" placeholder="Subjek" name="subjek" required>
                                    <label for="subjek">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Tulis pesanmu disini" id="pesan" style="height: 160px" name="pesan" required></textarea>
                                    <label for="pesan">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>Alamat</h4>
                            <p class="mb-0">Jl. Cakrawala No.5, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur, Indonesia</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-phone-alt fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>Mobile</h4>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-envelope-open fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>Email</h4>
                            <p class="mb-0">cv.wesada@gmail.com</p>
                        </div>
                    </div>
                    {{-- <div class="d-flex align-items-center">
                        <div class="me-4">
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fas fa-share fa-2x text-primary"></i></div>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-lg-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div> --}}
                </div>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="rounded h-100">
                        <iframe class="rounded w-100" 
                            style="height: 500px;" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.067788865056!2d112.6150968!3d-7.960589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788281bdd08839%3A0xc915f268bffa831f!2sUniversitas%20Negeri%20Malang!5e0!3m2!1sen!2sid!4v1694789253159!5m2!1sen!2sid" 
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

</x-layout.layout-master>

        
