<div class="container" x-data="{deleteCV: null, editCV:null, template_id:null}">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 rounded-3 shadow-sm p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="fs-5 p-3 fw-semibold">
                            <div class="d-inline-block p-2 bg-primary shadow text-white rounded-3 me-1">
                                <i style="height:22px;" data-feather="align-justify"></i>
                            </div>
                            CV List
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end mt-3">
                            <a class="d-inline-block p-2 rounded-3 fs-6 fw-medium float-right bg-white border shadow-sm border-primary text-decoration-none text-primary" href="<?php echo url('/cv/templates'); ?>">
                                <div class="d-inline-block p-1 bg-white text-primary border border-primary rounded-3 me-1">
                                    <i style="height:16px;" data-feather="plus"></i>
                                </div>
                                Create a new CV
                            </a>
                        </div>
                    </div>
                </div>
                <?php if (count($cvs)) : ?>
                    <?php foreach ($cvs as $key => $cv) : ?>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow-sm border-0 p-2 my-3" x-data="{showURL:false}">
                                    <div class="d-flex">
                                        <div class="d-flex me-3">
                                            <img style="height:190px; width:128px; object-fit:cover; margin-right:5px;" class="rounded-1 shadow" src="<?php echo getThumbnail($cv['id']); ?>" alt="thumbnail">
                                        </div>
                                        <div class="d-flex flex-column my-3 w-100">
                                            <h5 class="fs-5 fw-bold text-dark mb-3"> <?php echo 'CV - ' . $cv['name'] . '.pdf'; ?>
                                                <div class="ms-3 d-inline">
                                                    <button @click="editCV = <?php echo "'" . $cv['url'] . "'"; ?>; template_id = <?php echo "'" . $cv['template_id'] . "'"; ?>;setTimeout(() => document.getElementById('editForm').submit(),20)" class="d-inline-block btn btn-sm shadow-sm btn-light fw-normal text-primary" type="button">
                                                        <i style="height:14px;" data-feather="edit"></i>
                                                        Edit
                                                    </button>
                                                    <button @click="deleteCV = <?php echo "'" . $cv['url'] . "'"; ?>" class="d-inline-block btn btn-sm shadow-sm btn-light fw-normal text-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <i style="height:14px;" data-feather="trash"></i>
                                                        Delete
                                                    </button>
                                                </div>
                                            </h5>
                                            <h5 class="fw-semibold text-muted mb-3" style="font-size:14px;">
                                                <i style="height:16px;" data-feather="award"></i> <?php echo $cv['headline']; ?>
                                            </h5>
                                            <h6 class="fw-normal text-muted mb-3" style="font-size:12px">
                                                <i style="height:14px;" data-feather="clock"></i> <?php echo $cv['updated_at'] ?  'Last updated: ' . date_format(date_create($cv['updated_at']), "d-M-Y h:i A") : 'Created: ' . date_format(date_create($cv['created_at']), "d-M-Y h:i A"); ?>
                                            </h6>
                                            <div class="block w-100">
                                                <a class="d-inline-block btn btn-sm shadow btn-success fw-normal me-3" href="<?php echo url('/cv/download?url=' . $cv['url']); ?>" target="_blank">
                                                    <i style="height:14px;" data-feather="download"></i>
                                                    Download CV
                                                </a>
                                                <button @click="showURL = ! showURL" class="d-inline-block btn btn-sm shadow-sm btn-light fw-normal me-2" type="button">
                                                    <i style="height:14px;" data-feather="link"></i>
                                                </button>
                                                <div class="d-inline-block" style="width:320px;">
                                                    <input onClick="this.select();" x-show="showURL" readonly type="text" class="form-control outline-0" style="font-size:12px;" value="<?php echo url('/cv/download?url=' . $cv['url']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="row text-center" style="pointer-events:none;">
                        <img class="col" style="height:320px; width:320px; object-fit:contain; pointer-events:none; user-select:none;" draggable="false" src="<?php echo asset('/images/no-data.jpg') ?>" alt="no-data">
                        <p class="fs-5 fw-light text-center" style="color:#a1a1a1; pointer-events:none; user-select:none;"> It looks like you did not created any CV yet. </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete CV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete the CV?
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form id="deleteForm" action="<?php echo url('/cv/delete'); ?>" method="POST" class="d-none">
                        <input type="hidden" name="cv_url" x-bind:value="deleteCV">
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button @click="document.getElementById('deleteForm').submit()" type="button" class="btn btn-danger">Delete CV</button>
                </div>
            </div>
        </div>
    </div>
    <form id="editForm" action="<?php echo url('/cv/edit'); ?>" method="POST" class="d-none">
        <input type="hidden" name="cv_url" x-bind:value="editCV">
        <input type="hidden" name="template_id" x-bind:value="template_id">
    </form>
</div>