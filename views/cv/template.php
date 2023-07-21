<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 rounded-3 shadow-sm p-3">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="fs-5 p-3 fw-semibold">
                            <div class="d-inline-block p-2 bg-primary shadow text-white rounded-3 me-1">
                                <i style="height:22px;" data-feather="feather"></i>
                            </div>
                            Choose a template
                        </h3>
                    </div>
                </div>
                <div class="row text-center">
                    <?php foreach ($templates as $key => $value) : ?>
                        <div class="col-md-4 ">
                            <div class="shadow rounded m-3 p-2">
                                <a onclick="setTemplate(<?php echo $key; ?>)" style="cursor:pointer;">
                                    <?php if (!isset($value['options']) || !count($value['options'])) : ?>

                                        <img src="<?php echo asset('/images/templates/' . $value['thumbnail']) ?>" alt="<?php echo $value['thumbnail']; ?>" style="width:320px;filter:grayscale() blur(5px);">
                                    <?php else : ?>
                                        <img src="<?php echo asset('/images/templates/' . $value['thumbnail']) ?>" alt="<?php echo $value['thumbnail']; ?>" style="width:320px;">
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="templateForm" action="<?php echo url('/cv/create'); ?>" method="POST" class="d-none">
    <input type="number" name="template_id" id="template_id">
</form>
<script type="text/javascript">
    function setTemplate(template_id) {
        document.getElementById('template_id').value = template_id;
        document.getElementById('templateForm').submit();
    }
</script>