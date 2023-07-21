<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-8">
            <div class="card border-0 rounded-3 shadow-sm p-3">
                <h3 class="fs-5 p-3 fw-semibold">
                    <div class="d-inline-block p-2 bg-primary shadow text-white rounded-3 me-1">
                        <i style="height:22px;" data-feather="user"></i>
                    </div>
                    Profile Information
                </h3>
                <form class="w-100 p-3" action="<?php echo url('/user/update'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6" x-data="imageViewer('<?php echo getPhoto(auth()['photo']); ?>')">
                            <div class="d-inline-block rounded-3 p-3 shadow-sm">
                                <img style="height:256px; width:256px; object-fit:contain;" :src="imageUrl" alt="photo">
                            </div>
                            <input style="display:none;" name="photo" x-ref="image_input" type="file" accept="image/*" @change="fileChosen">
                            <div class="d-block text-center m-3" style="width:256px;  ">
                                <button @click="$refs.image_input.click()" type="button" class="btn btn-sm btn-primary fw-bold shadow-sm">
                                    <i style="height:16px;" data-feather="upload"></i>
                                    Upload Photo
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="flex flex-row w-100 p-3">
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">Name</p>
                                    <input name="name" type="text" value="<?php echo auth()['name']; ?>" class="flex form-control" required />
                                </div>
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">Email</p>
                                    <input name="email" value="<?php echo auth()['email']; ?>" type="email" class="flex form-control" required />
                                </div>
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">Address</p>
                                    <textarea spellcheck="false" name="address" class="form-control"><?php echo auth()['address']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex w-100 ">
                        <button type="submit" class="ms-auto btn btn-primary fw-bold shadow-sm">
                            <i style="height:22px;" data-feather="save"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12 col-xl-4">
            <div class="card border-0 rounded-3 shadow-sm p-3">
                <h3 class="fs-5 p-3 fw-semibold">
                    <div class="d-inline-block p-2 bg-primary shadow text-white rounded-3 me-1">
                        <i style="height:22px;" data-feather="key"></i>
                    </div>
                    Update Password
                </h3>
                <form class="w-100 p-3" action="<?php echo url('/user/update_password'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex flex-row w-100 p-3">
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">Current Password</p>
                                    <input name="current_password" type="password" class="flex form-control" required />
                                </div>
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">New Password</p>
                                    <input name="new_password" type="password" class="flex form-control" required />
                                </div>
                                <div class="flex w-100 mb-3">
                                    <p class="text-start fs-6 fw-semibold mb-1">Confirm Password</p>
                                    <input name="password_confirmation" type="password" class="flex form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex w-100">
                        <button type="submit" class="ms-auto btn btn-primary fw-bold shadow-sm">
                            <i style="height:22px;" data-feather="key"></i>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function imageViewer(src = '') {
            return {
                imageUrl: src,

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>