<div class="container">
    <form action="<?php echo url('/cv/update'); ?>" method="POST">
        <?php if (count($template_options)) : ?>

            <div class="card border-0 rounded-3 shadow-sm p-3" x-data="{ skills: getParsed('skills'), educations: getParsed('educations'), experiences:getParsed('experiences'), references:getParsed('references'), languages:getParsed('languages'), hobbies:getParsed('hobbies'), social_links:getParsed('social_links'), awards:getParsed('awards'), activities:getParsed('activities'), with_percentage:   <?php echo ($template_options['skill']['no_percentage'] == 1 && $template_options['skill']['percentage'] == 1) ? 1 : (($template_options['skill']['no_percentage'] == 1 && $template_options['skill']['percentage'] == 0) ? 0 : 1); ?>, name_size: <?php echo $cv_data['name_size']; ?>}">
                <input type="hidden" name="cv_id" value="<?php echo $cv_data['id']; ?>">
                <input type="hidden" name="cv_url" value="<?php echo $cv_data['url']; ?>">
                <input type="hidden" name="template_id" value="<?php echo $data['template_id']; ?>">
                <input type="hidden" name="with_percentage" x-bind:value="with_percentage">
                <input type="hidden" name="name_size" x-bind:value="name_size">
                <input type="hidden" name="skills" x-bind:value="JSON.stringify(skills)">
                <input type="hidden" name="educations" x-bind:value="JSON.stringify(educations)">
                <input type="hidden" name="experiences" x-bind:value="JSON.stringify(experiences)">
                <input type="hidden" name="languages" x-bind:value="JSON.stringify(languages)">
                <input type="hidden" name="references" x-bind:value="JSON.stringify(references)">
                <input type="hidden" name="hobbies" x-bind:value="JSON.stringify(hobbies)">
                <input type="hidden" name="awards" x-bind:value="JSON.stringify(awards)">
                <input type="hidden" name="activities" x-bind:value="JSON.stringify(activities)">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <h3 class="fs-5 p-3 fw-semibold">
                                <div class="d-inline-block p-2 bg-primary shadow text-white rounded-3 me-1">
                                    <i style="height:22px;" data-feather="file-text"></i>
                                </div>
                                Update CV
                            </h3>
                        </div>
                        <!-- Personal Information Starts Here  -->
                        <div class="p-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                            <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                <i style="height:24px;" data-feather="user" class="me-2"></i>
                                Personal Information
                            </h3>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="name">Full Name</span>
                                        <input name="name" type="text" class="form-control" value="<?php echo $cv_data['name']; ?>" placeholder="Your Full Name" aria-label="name" aria-describedby="name" required>
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" x-html="`Font Size: `+ name_size"></button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" x-on:click="name_size = 22">22</a></li>
                                            <li><a class="dropdown-item" x-on:click="name_size = 24">24</a></li>
                                            <li><a class="dropdown-item" x-on:click="name_size = 28">28</a></li>
                                            <li><a class="dropdown-item" x-on:click="name_size = 33">33</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="headline">Headline</span>
                                        <input name="headline" type="text" class="form-control" value="<?php echo $cv_data['headline']; ?>" aria-label="headline" aria-describedby="headline" required>
                                    </div>
                                </div>
                                <?php if (isset($template_options['about'])) : ?>
                                    <div class="col-md-12">
                                        <div class="flex w-100 mb-2">
                                            <p class="text-start fs-6 fw-normal mb-1">About Me</p>
                                            <textarea name="about" rows="3" name="about" class="form-control"><?php echo $cv_data['about']; ?></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($template_options['career_objective'])) : ?>
                                    <div class="col-md-12">
                                        <div class="flex w-100 mb-2">
                                            <p class="text-start fs-6 fw-normal mb-1">Career Objectives</p>
                                            <textarea name="objectives" rows="3" name="objectives" class="form-control" required><?php echo $cv_data['objectives']; ?></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Personal Information Ends Here  -->
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <!-- Contact Information Starts Here  -->
                        <div class="p-3 mt-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                            <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                <i style="height:24px;margin-top:2px;margin-top:2px;" data-feather="book" class="me-2"></i>
                                Contact Information
                            </h3>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="email">Email</span>
                                        <input name="email" type="email" class="form-control" value="<?php echo $cv_data['email']; ?>" placeholder="Your Email Address" aria-label="email" aria-describedby="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="mobile">Mobile</span>
                                        <input name="mobile" type="text" class="form-control" value="<?php echo $cv_data['mobile']; ?>" placeholder="Mobile Number" aria-label="mobile" aria-describedby="mobile" required>
                                    </div>
                                </div>
                                <?php if (isset($template_options['website'])) : ?>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="email">Website</span>
                                            <input name="website" type="text" class="form-control" value="<?php echo $cv_data['website']; ?>" placeholder="Website url" aria-label="website" aria-describedby="website">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="flex w-100 mb-2">
                                        <p class="text-start fs-6 fw-normal mb-1">Address</p>
                                        <textarea name="address" class="form-control" required><?php echo $cv_data['address']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Information Ends Here  -->
                        <?php if (isset($template_options['skill'])) : ?>
                            <!-- Skills Starts Here -->
                            <div class="p-3 mt-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                                <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                    <i style="height:24px;margin-top:2px;" data-feather="award" class="me-2"></i>
                                    Skills
                                </h3>
                                <div class="row g-3 align-items-start">
                                    <div class="col-md-6">
                                        <?php if ($template_options['skill']['percentage'] == 1 && $template_options['skill']['no_percentage'] == 1) : ?>
                                            <select x-bind:disabled="skills.length !== 0 && with_percentage == 0" class="mb-3 form-select" style="width:270px;" x-model="with_percentage">
                                                <option value="1" selected>With Percentage (%)</option>
                                                <option value="0">No Percentage </option>
                                            </select>
                                        <?php endif; ?>

                                        <template x-if="skills.length && with_percentage == 1">
                                            <template x-for="skill in skills">
                                                <div class="card position-relative p-2 mb-1 rounded-3">
                                                    <span class="fw-bold" x-text="skill.title"></span>
                                                    <div class="progress d-inline-block" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar" :style="`width: ${skill.percentage}%`" x-text="skill.percentage + '%'"></div>
                                                    </div>
                                                    <div class="position-absolute top-0 start-100 translate-middle bg-danger border border-light" x-on:click="skills = skills.filter(s => s.id != skill.id)" style="cursor:pointer; padding:3px 6px 2px 6px; color:#FFFFFF; font-size:9px; border-radius:50%;">
                                                        &#x2715
                                                    </div>
                                                </div>
                                            </template>
                                        </template>
                                        <template x-if="skills.length && with_percentage == 0">
                                            <template x-for="skill in skills">
                                                <div class="d-inline-block position-relative me-3 mb-3 border border-primary bg-white fw-bold text-primary px-2 py-1 rounded-3">
                                                    <span style="font-size: 13px;" x-text="skill.title"> </span>
                                                    <div class="position-absolute top-0 start-100 translate-middle bg-danger border border-light" x-on:click="skills = skills.filter(s => s.id != skill.id)" style="cursor:pointer; padding:3px 6px 2px 6px; color:#FFFFFF; font-size:9px; border-radius:50%;">
                                                        &#x2715
                                                    </div>
                                                </div>
                                            </template>
                                        </template>
                                        <div class="input-group my-3">
                                            <input x-ref="skill_title" type="text" class="form-control" placeholder="Skill Title" aria-label="skill" aria-describedby="skill">
                                            <span x-show="with_percentage == 1" class="input-group-text">(%)</span>
                                            <input x-show="with_percentage == 1" x-ref="skill_percentage" type="number" min="0" max="100" class="form-control" placeholder="Skill Percentage">
                                            <button x-on:click="
                                if($refs.skill_percentage.value && $refs.skill_title.value){
                                    skills.push({id:skills.length ? skills.reduce((prev, current) => (prev.id > current.id) ? prev : current).id + 1 : 1,title:$refs.skill_title.value, percentage: $refs.skill_percentage.value});
                                    $refs.skill_title.value = ''; $refs.skill_percentage.value = ''; 
                                }
                                else {
                                    if(with_percentage == 0 && $refs.skill_title.value) {
                                        skills.push({id:skills.length ? skills.reduce((prev, current) => (prev.id > current.id) ? prev : current).id + 1 : 1,title:$refs.skill_title.value});
                                        $refs.skill_title.value = ''; $refs.skill_percentage.value = ''; 
                                    }
                                }
                                " class="btn btn-primary fw-normal z-1" type="button"> <i style="height:20px;" data-feather="plus"></i>
                                                Add Skill</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Skills Ends Here -->
                        <?php endif; ?>
                        <?php if (isset($template_options['education'])) : ?>
                            <!-- Education Starts Here -->
                            <div class="p-3 mt-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                                <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                    <i style="height:24px;margin-top:2px;" data-feather="book-open" class="me-2"></i>
                                    Education
                                </h3>
                                <div class="row g-3 align-items-start">
                                    <div class="col">
                                        <template x-if="educations.length ">
                                            <div class="row">
                                                <template x-for="education in educations">
                                                    <div class="col-md-4">
                                                        <div class="card position-relative p-2 mb-1 rounded-3">
                                                            <span class="fw-bold" x-text="education.institute"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="education.course"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="`Duration: ${education.duration}`"></span>
                                                            <span x-show='education.concentration.replace(/^\s+|\s+$/g,"").length' style="font-size:12px;" class="fw-medium" x-text="`Concentration: ${education.concentration}`"></span>
                                                            <div class="position-absolute top-0 start-100 translate-middle bg-danger border border-light" x-on:click="educations = educations.filter(edu => edu.id != education.id)" style="cursor:pointer; padding:3px 6px 2px 6px; color:#FFFFFF; font-size:9px; border-radius:50%;">
                                                                &#x2715
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                        <div class="input-group my-3">
                                            <input x-ref="education_institute" type="text" class="form-control" placeholder="Institute Name">
                                            <span class="input-group-text">Course Title</span>
                                            <input x-ref="education_course" type="text" class="form-control" placeholder="Course Title">
                                            <span class="input-group-text">Duration</span>
                                            <input x-ref="education_duration" type="text" class="form-control" placeholder="Duration">
                                        </div>
                                        <div class="flex w-100 mb-2">
                                            <p class="text-start fs-6 fw-normal mb-1">Concentration</p>
                                            <textarea x-ref="education_concentration" rows="3" class="form-control"></textarea>
                                        </div>
                                        <button x-on:click="
                                if($refs.education_institute.value && $refs.education_course.value && $refs.education_duration.value){
                                    educations.push({id:educations.length ? educations.reduce((prev, current) => (prev.id > current.id) ? prev : current).id + 1 : 1,
                                        institute:$refs.education_institute.value, 
                                        course:$refs.education_course.value, 
                                        duration:$refs.education_duration.value,
                                        concentration:$refs.education_concentration.value
                                        });
                                    $refs.education_institute.value = ''; 
                                    $refs.education_course.value = ''; 
                                    $refs.education_duration.value = ''; 
                                    $refs.education_concentration.value = ''; 
                                }                                
                                " class="btn btn-primary fw-normal" type="button"> <i style="height:22px;" data-feather="plus"></i>
                                            Add Education</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Education Ends Here -->
                        <?php endif; ?>
                        <?php if (isset($template_options['experience'])) : ?>
                            <!-- Experience Starts Here -->
                            <div class="p-3 mt-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                                <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                    <i style="height:24px;margin-top:2px;" data-feather="briefcase" class="me-2"></i>
                                    Experience
                                </h3>
                                <div class="row g-3 align-items-start">
                                    <div class="col">
                                        <template x-if="experiences.length ">
                                            <div class="row">
                                                <template x-for="experience in experiences">
                                                    <div class="col-md-4">
                                                        <div class="card position-relative p-2 mb-1 rounded-3">
                                                            <span class="fw-bold" x-text="experience.company"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="experience.job_title"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="`Duration: ${experience.duration}`"></span>
                                                            <span x-show='experience.job_responsibilities.replace(/^\s+|\s+$/g,"").length' style="font-size:12px;" class="fw-medium" x-text="`Job Responsibilities: ${experience.job_responsibilities}`"></span>
                                                            <div class="position-absolute top-0 start-100 translate-middle bg-danger border border-light" x-on:click="experiences = experiences.filter(exp => exp.id != experience.id)" style="cursor:pointer; padding:3px 6px 2px 6px; color:#FFFFFF; font-size:9px; border-radius:50%;">
                                                                &#x2715
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Company Name</span>
                                            <input x-ref="experience_company" type="text" class="form-control" placeholder="Company Name">
                                            <span class="input-group-text w-5">City</span>
                                            <input x-ref="experience_company_city" type="text" class="form-control" style="width:32px;" placeholder="City">
                                        </div>
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Job Title</span>
                                            <input x-ref="experience_job_title" type="text" class="form-control" placeholder="Job Title">
                                            <span class="input-group-text">Duration</span>
                                            <input x-ref="experience_duration" type="text" class="form-control" placeholder="Duration">
                                        </div>
                                        <div class="flex w-100 mb-2">
                                            <p class="text-start fs-6 fw-normal mb-1">Job Responsibilities</p>
                                            <textarea x-ref="experience_job_responsibilities" rows="3" class="form-control"></textarea>
                                        </div>
                                        <button x-on:click="
                                if($refs.experience_company.value && $refs.experience_company_city && $refs.experience_job_title.value && $refs.experience_duration.value){
                                    experiences.push({id:experiences.length ? experiences.reduce((prev, current) => (prev.id > current.id) ? prev : current).id + 1 : 1,
                                        company:$refs.experience_company.value, 
                                        company_city:$refs.experience_company_city.value, 
                                        job_title:$refs.experience_job_title.value, 
                                        duration:$refs.experience_duration.value,
                                        job_responsibilities:$refs.experience_job_responsibilities.value
                                        });
                                    $refs.experience_company.value = ''; 
                                    $refs.experience_company_city.value = ''; 
                                    $refs.experience_job_title.value = ''; 
                                    $refs.experience_duration.value = ''; 
                                    $refs.experience_job_responsibilities.value = ''; 
                                }                                
                                " class="btn btn-primary fw-normal" type="button"> <i style="height:22px;" data-feather="plus"></i>
                                            Add Experience</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Experience Ends Here -->
                        <?php endif; ?>
                        <?php if (isset($template_options['reference'])) : ?>
                            <!-- References Starts Here -->
                            <div class="p-3 mt-3" style="border:1px dashed #e1e1e1; border-radius:12px;">
                                <h3 class="d-flex align-middle fs-4 fw-normal mb-3">
                                    <i style="height:24px;margin-top:2px;" data-feather="users" class="me-2"></i>
                                    References
                                </h3>
                                <div class="row g-3 align-items-start">
                                    <div class="col">
                                        <template x-if="references.length ">
                                            <div class="row">
                                                <template x-for="reference in references">
                                                    <div class="col-md-4">
                                                        <div class="card position-relative p-2 mb-1 rounded-3">
                                                            <span class="fw-bold" x-text="reference.name"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="`${reference.designation} - ${reference.company}`"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="`Contact No: ${reference.contact_no}`"></span>
                                                            <span style="font-size:12px;" class="fw-medium" x-text="`Email: ${reference.email}`"></span>
                                                            <div class="position-absolute top-0 start-100 translate-middle bg-danger border border-light" x-on:click="references = references.filter(ref => ref.id != reference.id)" style="cursor:pointer; padding:3px 6px 2px 6px; color:#FFFFFF; font-size:9px; border-radius:50%;">
                                                                &#x2715
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Person Name</span>
                                            <input x-ref="reference_name" type="text" class="form-control" placeholder="Reference Person Name">
                                            <span class="input-group-text w-5">Designation</span>
                                            <input x-ref="reference_designation" type="text" class="form-control" style="width:32px;" placeholder="Designation">
                                        </div>
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Company Name</span>
                                            <input x-ref="reference_company" type="text" class="form-control" placeholder="Company Name">
                                        </div>
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Contact No</span>
                                            <input x-ref="reference_contact_no" type="text" class="form-control" placeholder="Contact No">
                                            <span class="input-group-text">Email</span>
                                            <input x-ref="reference_email" type="email" class="form-control" placeholder="Email">
                                        </div>

                                        <button x-on:click="
                                if($refs.reference_name.value && $refs.reference_designation && $refs.reference_company.value && $refs.reference_contact_no.value && $refs.reference_email.value){
                                    references.push({id:references.length ? references.reduce((prev, current) => (prev.id > current.id) ? prev : current).id + 1 : 1,
                                        name:$refs.reference_name.value, 
                                        designation:$refs.reference_designation.value, 
                                        company:$refs.reference_company.value, 
                                        contact_no:$refs.reference_contact_no.value,
                                        email:$refs.reference_email.value,                                     
                                        });
                                    $refs.reference_name.value = ''; 
                                    $refs.reference_designation.value = ''; 
                                    $refs.reference_company.value = ''; 
                                    $refs.reference_contact_no.value = ''; 
                                    $refs.reference_email.value = ''; 
                                }                                
                                " class="btn btn-primary fw-normal" type="button"> <i style="height:22px;" data-feather="plus"></i>
                                            Add Reference</button>
                                    </div>
                                </div>
                            </div>
                            <!-- References Ends Here -->
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mx-auto my-3">
                    <div class="col">
                        <div class="d-flex flex-column align-middle justify-content-center">
                            <p style="font-size: 12px;" class="d-flex justify-content-center">
                                <i style="height:14px; margin-top:1px;" data-feather="info"></i>Before proceding, Check your given informations are correct.
                            </p>
                            <button class="d-inline-block btn shadow btn-success fw-normal" type="submit">
                                <i style="height:22px;" data-feather="aperture"></i>
                                Update CV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="card border-0 rounded-3 shadow-sm p-3">
                <div class="row">
                    <div class="col text-center">
                        <div class="d-inline-block p-2 rounded-3 bg-white border shadow-sm border-warning" href="<?php echo url('/cv/template'); ?>">
                            <img src="<?php echo asset('/images/templates/template_' . $data['template_id'] . '.webp'); ?>" alt="<?php echo 'template_' . $data['template_id']; ?>" style="width:256px;filter:grayscale() blur(3px); user-select:none;" draggable="false">
                        </div>
                        <h4 class="fw-light text-muted fs-4 mt-5">Sorry! This template is under construction.</h4>
                        <a href="<?php echo url('/cv/templates'); ?>" class="fw-bold d-block text-decoration-none mb-2">
                            <i style="height:18px;" data-feather="arrow-left"></i>
                            Choose another template
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
    function getParsed(term) {
        switch (term) {
            case 'skills':
                return JSON.parse('<?php echo ($cv_data['skills'] ?: '[{}]'); ?>');
            case 'educations':
                return JSON.parse('<?php echo ($cv_data['educations'] ?: '[{}]'); ?>');
            case 'experiences':
                return JSON.parse('<?php echo ($cv_data['experiences'] ?: '[{}]'); ?>');
            case 'references':
                return JSON.parse('<?php echo ($cv_data['references'] ?: '[{}]'); ?>');
            case 'languages':
                return JSON.parse('<?php echo ($cv_data['languages'] ?: '[{}]'); ?>');
            case 'hobbies':
                return JSON.parse('<?php echo ($cv_data['hobbies'] ?: '[{}]'); ?>');
            case 'social_links':
                return JSON.parse('<?php echo ($cv_data['social_links'] ?: '[{}]'); ?>');
            case 'awards':
                return JSON.parse('<?php echo ($cv_data['awards'] ?: '[{}]'); ?>');
            case 'activities':
                return JSON.parse('<?php echo ($cv_data['activities'] ?: '[{}]'); ?>');
        }
    }
</script>