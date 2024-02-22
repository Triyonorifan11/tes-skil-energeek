@extends('layouts.body')
@section('content')
    <div class="register-box poppins py-5">
        <div class="register-logo  mt-5">
            <a href="/">
                <img src="{{ url('assets/images/logo.svg') }}" alt="logo">
            </a>
        </div>
        <div class="card rounded">
            <div class="card-body rounded-lg">
                <p class="login-box-msg text-bold">Apply Lamaran</p>

                <form action="#" method="post" id="apply_lamaran">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Cth: Jhonatan Akbar" />
                    </div>
                    <div class="form-group">
                        <label for="job_id">Jabatan</label>
                        <select id="job_id" name="job_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih Jabatan</option>
                            @foreach ($jobs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" name="phone" class="form-control" id="phone"
                            placeholder="Cth: 0893239851289" data-inputmask="'mask': ['999999999999']" data-mask />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Enter email" />
                    </div>
                    <div class="form-group">
                        <label for="year">Tahun Lahir</label>
                        <select id="year" name="year" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih tahun</option>
                            @foreach ($years as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="skill">Skill Set</label>
                        <select id="skill" name="skill" class="form-control select2" style="width: 100%;"
                            multiple="multiple" data-placeholder="Select a State">
                            @foreach ($skills as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">Register</button>
                </form>


            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $("#apply_lamaran").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        // minlength: 5,
                    },
                    name: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Masukkan Email!",
                        email: "Email tidak sesuai, sertakan @ pada alamat email",
                    },
                    phone: {
                        required: "Masukkan Nomor telepon",
                        // minlength: "Your password must be at least 5 characters long",
                    },
                    name: "Masukkan nama lengkap!",
                },
                errorElement: "span",
                submitHandler: function(form, e) {
                    // alert
                    // alert("Form successful submitted!");
                    e.preventDefault()
                    const formData = new FormData(form);
                    const dataObj = {};
                    formData.forEach((value, key) => {
                        (dataObj[key] = value);
                    })
                    var selectedSkill = [];
                    var selectElement = document.getElementById('skill');
                    for (var option of selectElement.selectedOptions) {
                        selectedSkill.push(option.value);
                    }
                    dataObj.skill = selectedSkill;
                    storeData(dataObj);
                },
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
            });
        });

        async function storeData(data) {
            const url = "{{ url('/api/candidate/store') }}";
            let response = await fetch(`${url}`, {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            let result = await response.json();
            if (result.status == 200 && result.isWarning == false) {
                Swal.fire({
                    title: 'Berhasil',
                    text: result.message,
                    icon: "success"
                });
            } else {
                const objres = result.data;
                const res = Object.values(objres);
                Swal.fire({
                    title: 'Gagal',
                    text: res,
                    icon: "error"
                });
            }
        }
    </script>
@endsection
