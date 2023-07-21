<!DOCTYPE html>
<html lang="en">

<?php

use App\Providers\Photo;
?>

<head>
    <title>CV - <?php echo $_POST['name']; ?></title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        h2 {
            padding: 0;
            margin: 0;
        }

        body {
            font-family: "Raleway";
        }

        .page {
            text-align: center;
            margin: 0 auto;
            height: 210mm;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="page">
        <div style="
          margin: 0 auto;
          width: 50%;
          background-color: #29343a;
          height: 100%;
          left: 0;
          position: fixed;       
        ">
            <div style="
                position: absolute;
                right:30px;
                bottom:740px;
                width:600px;        
                transform: rotate(-90deg);       
          ">
                <h2 style="                        
              text-align: right;
              font-weight: 900;
              font-size: <?php echo $_POST['name_size'] . 'px'; ?>;
              letter-spacing: 0px;
              color: white; 
              text-transform: uppercase;
            ">
                    <?php echo $_POST['name']; ?>
                </h2>
                <p style="
              text-align: right;
              font-weight: 400;
              font-size: 12px;
              letter-spacing: 2px;
              color: white;
              text-transform: uppercase;
            ">
                    <?php echo $_POST['headline']; ?>
                </p>
            </div>
            <div style="position: absolute; top: 50px; right: 0;">
                <img src="<?php echo Photo::getCVPhoto(230, 200); ?>" alt="photo" style="
              padding: 5px 0px 5px 5px;
              background: #fff;
              height: 230px;
              width: 200px;
              object-fit: cover;      
            " />
            </div>
            <div style="height:100%; width:100%; margin-top:350px;">
                <div style="margin-left:50px;text-align:left;">
                    <?php if (isset($_POST['about'])) : ?>
                        <!-- About Me  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 5px; border-radius:100%; display:inline-block;">
                            <img style="height:18px;width:18px; object-fit:contain; margin-top:2px;" src="<?php echo template_assets($_POST['template_id'], 'about.png'); ?>" alt="about-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle ;font-weight:800; color:white; font-size:18px; text-transform:uppercase; text-align:left;">About Me</h4>
                        <p style="font-size:11px; font-weight:400; color:white; margin-top:15px; padding-right:50px; text-align:justify;">
                            <?php echo $_POST['about']; ?>
                        </p>
                        <!-- About Me Ends Here  -->
                    <?php endif; ?>
                    <div style="margin-top: 20px; margin-bottom:20px;"></div>
                    <?php if (count(json_decode($_POST['educations']))) : ?>
                        <!-- Education  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 6px; border-radius:100%; display:inline-block;">
                            <img style="height:10px;width:18px; object-fit:contain; margin-top:7px;" src="<?php echo template_assets($_POST['template_id'], 'education.png'); ?>" alt="education-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle ;font-weight:800; color:white; font-size:18px; text-transform:uppercase; text-align:left;">Education</h4>
                        <div style="padding-left: 15px; margin-top:-4px;">
                            <ul style="border-left: 2px solid #05c5dd; list-style:none; padding-top:15px; padding-bottom:1px; margin-right:50px;">
                                <?php
                                $educations = json_decode($_POST['educations']);
                                foreach ($educations as $key => $education) : ?>
                                    <li style="position:relative; <?php echo count($educations) > $key + 1 ? ' margin-bottom:20px;' :  'margin-bottom:8px;'; ?>">
                                        <div style="position:absolute;top:7px;left:-6.5px; border-radius:50%; background:#293339; padding:2px;">
                                            <div style=" height:7px; width:7px; border-radius:50%; background:#05c5dd;"></div>
                                        </div>
                                        <p style="display:block; margin-left:30px; color:#FFFFFF; font-weight:700; font-size:14px;"><?php echo $education->institute; ?></p>
                                        <p style="display:block; margin-left:30px; color:#FFFFFF; font-weight:400; font-size:12px;"><?php echo $education->course; ?></p>
                                        <p style="display:block; margin-left:30px; color:#05c5dd; font-weight:400; font-size:12px;"><?php echo $education->duration; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Education Ends Here  -->
                    <?php endif; ?>
                    <div style="margin-top: 20px; margin-bottom:20px;"></div>
                    <?php if (count(json_decode($_POST['skills']))) : ?>
                        <!-- Skills  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 6px; border-radius:100%; display:inline-block;">
                            <img style="height:18px;width:18px; object-fit:contain; margin-top:3px;" src="<?php echo template_assets($_POST['template_id'], 'skill.png'); ?>" alt="skill-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle;font-weight:800; color:white; font-size:18px; text-transform:uppercase; text-align:left;">Skills</h4>
                        <div style="padding-top:15px; padding-bottom:1px;">
                            <?php
                            $cols = 0;
                            $skills = json_decode($_POST['skills']);
                            foreach ($skills as $key => $skill) :
                                if ($cols == 0) :
                            ?>
                                    <div style="display: block; margin-top:5px;">
                                    <?php endif; ?>
                                    <div style="display:inline-block; vertical-align:top; position:relative; <?php echo  $cols = 1 ? 'margin-right:15px;' : 'margin-right:0px;' ?> width:140px;font-weight:400; font-size:10px; color:#FFFFFF;">
                                        <p style="width:95px; vertical-align:middle;">
                                            <?php echo $skill->title ?>
                                        </p>
                                        <?php if (isset($skill->percentage)) : ?>
                                            <div style="position:absolute; right:0;  top:0;">
                                                <div style="width:41px;height:6px; position:relative;">
                                                    <div style="left:0; position:absolute;">
                                                        <?php for ($j = 0; $j < 5; $j++) : ?>
                                                            <img style="height:6px; width:6px;" src="<?php echo template_assets($_POST['template_id'], 'star-blank.png'); ?>" alt="star-blank">
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="position:absolute; right:0;top: 0px;width:41px;">
                                                <div style="position:relative;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;left:0; height:15px;  width:<?php echo number_format($skill->percentage * 41 / 100, 2) . 'px'; ?>;">
                                                    <div style="position:absolute;">
                                                        <?php for ($j = 0; $j < 5; $j++) : ?>
                                                            <img style="height:6px; width:6px;" src="<?php echo template_assets($_POST['template_id'], 'star-filled.png'); ?>" alt="star-filled">
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($cols == 1 || $key + 1 == count($skills)) : $cols = 0; ?>
                                    </div>
                                <?php else : $cols++;
                                    endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <!-- Skills Ends Here  -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div style="
          margin: 0 auto;
          width: 50%;
          background-color: #FFFFFF;
          height: 100%;
          right: 0;
          position: fixed;       
        ">
            <div style="height:100%; width:100%; margin-top:50px;">
                <div style="margin-left:50px;text-align:left;">
                    <?php if (isset($_POST['mobile']) || isset($_POST['secondary_mobile']) || isset($_POST['email']) || isset($_POST['website']) || isset($_POST['address'])) : ?>
                        <!-- Contact Me  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 7px; border-radius:100%; display:inline-block;">
                            <img style="height:18px;width:14px; object-fit:contain; margin-top:4px;" src="<?php echo template_assets($_POST['template_id'], 'contact.png'); ?>" alt="contact-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle;font-weight:800; color:#293339; font-size:18px; text-transform:uppercase; text-align:left;">Contact Me</h4>
                        <div style="padding-left: 13px; margin-top:-4px;">
                            <ul style="border-left: 2px solid #05c5dd; list-style:none; padding-top:20px; padding-bottom:1px; margin-right:50px;">
                                <li style="position:relative; margin-bottom:20px;">
                                    <div style="position:absolute;top:7px;left:-6.8px; border-radius:50%; background:#ffffff; padding:2px;">
                                        <div style="height:7.5px; width:7.5px; border-radius:50%; background:#05c5dd;"></div>
                                    </div>
                                    <div style="display:block; margin-left:30px; color:#29343a; font-weight:400; font-size:12px;">
                                        <div style="background:#05c5dd; vertical-align:middle; margin-top:5px; margin-right:5px;height:18px; width:18px;  border-radius:100%; display:inline-block;">
                                            <img style="height:12px; width:8px;margin-left:5px; margin-top:2.5px;" src="<?php echo template_assets($_POST['template_id'], 'phone.png'); ?>" alt="phone-icon">
                                        </div>
                                        <p style="color:#29343a;vertical-align:middle; display:inline-block; margin-top:3px; font-size:12px;"> <?php echo $_POST['mobile']; ?></p>
                                    </div>
                                </li>
                                <li style="position:relative; margin-bottom:20px;">
                                    <div style="position:absolute;top:7px;left:-6.8px; border-radius:50%; background:#ffffff; padding:2px;">
                                        <div style="height:7.5px; width:7.5px; border-radius:50%; background:#05c5dd;"></div>
                                    </div>
                                    <div style="display:block; margin-left:30px; color:#29343a; font-weight:400; font-size:12px;">
                                        <div style="background:#05c5dd; vertical-align:middle; margin-top:5px; margin-right:5px;height:18px; width:18px;  border-radius:100%; display:inline-block;">
                                            <img style="height:10px; width:10px;margin-left:4px; margin-top:4.3px;" src="<?php echo template_assets($_POST['template_id'], 'web.png'); ?>" alt="web-icon">
                                        </div>
                                        <div style="vertical-align:middle; display:inline-block; margin-top:3px; font-size:12px;">
                                            <p style="color:#29343a;"> <?php echo $_POST['website']; ?></p>
                                            <p style="color:#29343a;"> <?php echo $_POST['email']; ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li style="position:relative; margin-bottom:8px;">
                                    <div style="position:absolute;top:7px;left:-6.8px; border-radius:50%; background:#ffffff; padding:2px;">
                                        <div style="height:7.5px; width:7.5px; border-radius:50%; background:#05c5dd;"></div>
                                    </div>
                                    <div style="display:block; margin-left:30px; color:#29343a; font-weight:400; font-size:12px;">
                                        <div style="background:#05c5dd; vertical-align:middle; margin-top:5px; margin-right:5px;height:18px; width:18px;  border-radius:100%; display:inline-block;">
                                            <img style="height:10px; width:7px;margin-left:5.5px; margin-top:4px;" src="<?php echo template_assets($_POST['template_id'], 'location.png'); ?>" alt="location-icon">
                                        </div>
                                        <p style="color:#29343a; vertical-align:middle; width:225px; display:inline-block; margin-top:3px; font-size:12px;"> <?php echo $_POST['address']; ?></p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <!-- Contact Me Ends Here  -->
                    <?php endif; ?>
                    <div style="margin-top: 20px; margin-bottom:20px;"></div>
                    <?php if (count(json_decode($_POST['experiences']))) : ?>
                        <!-- Job Experience  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 7px; border-radius:100%; display:inline-block;">
                            <img style="height:14px;width:14px; object-fit:contain; margin-top:6px;" src="<?php echo template_assets($_POST['template_id'], 'briefcase.png'); ?>" alt="briefcase-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle;font-weight:800; color:#293339; font-size:18px; text-transform:uppercase; text-align:left;">Job Experience</h4>
                        <div style="padding-left: 13px; margin-top:-4px;">
                            <ul style="border-left: 2px solid #05c5dd; list-style:none; padding-top:20px; padding-bottom:1px; margin-right:50px;">
                                <?php $experiences = json_decode($_POST['experiences']);
                                foreach ($experiences as $key => $experience) : ?>
                                    <li style="position:relative; <?php echo count($experiences) > $key + 1 ? ' margin-bottom:20px;' :  'margin-bottom:8px;'; ?>">
                                        <div style="position:absolute;top:8px;left:-6.8px; border-radius:50%; background:#ffffff; padding:2px;">
                                            <div style="height:7.5px; width:7.5px; border-radius:50%; background:#05c5dd;"></div>
                                        </div>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:700; font-size:14px;"><?php echo $experience->job_title; ?></p>
                                        <p style="position:absolute;right:0; top:3px; color:#05c5dd; font-weight:700; font-size:12px;"><?php echo $experience->duration; ?></p>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:500; font-style:italic; font-size:12px;"><?php echo $experience->company; ?> / <?php echo $experience->company_city; ?></p>
                                        <p style="display:block; margin-left:30px; color:#29343a; margin-top:10px; font-weight:400; font-size:10px;"><?php echo $experience->job_responsibilities; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Job Experience Ends Here  -->
                    <?php endif; ?>
                    <div style="margin-top: 20px; margin-bottom:20px;"></div>
                    <?php if (count(json_decode($_POST['references']))) : ?>
                        <!-- References  -->
                        <div style="background:#05c5dd; vertical-align:middle; margin-right:10px; padding:2px 6px; border-radius:100%; display:inline-block;">
                            <img style="height:12px;width:16px; object-fit:contain; margin-top:7px;" src="<?php echo template_assets($_POST['template_id'], 'references.png'); ?>" alt="references-icon">
                        </div>
                        <h4 style="display:inline-block;vertical-align:middle;font-weight:800; color:#293339; font-size:18px; text-transform:uppercase; text-align:left;">References</h4>
                        <div style="padding-left: 13px; margin-top:-4px;">
                            <ul style="border-left: 2px solid #05c5dd; list-style:none; padding-top:20px; padding-bottom:1px; margin-right:50px;">
                                <?php $references = json_decode($_POST['references']);
                                foreach ($references as $key => $reference) : ?>
                                    <li style="position:relative; <?php echo count($references) > $key + 1 ? ' margin-bottom:20px;' :  'margin-bottom:8px;'; ?>">
                                        <div style="position:absolute;top:8px;left:-6.8px; border-radius:50%; background:#ffffff; padding:2px;">
                                            <div style="height:7.5px; width:7.5px; border-radius:50%; background:#05c5dd;"></div>
                                        </div>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:700; font-size:14px;"><?php echo $reference->name; ?></p>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:500; font-style:italic; font-size:12px;"><?php echo $reference->designation; ?> - <?php echo $reference->company; ?></p>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:400; font-size:10px;"><?php echo 'Contact: ' . $reference->contact_no; ?></p>
                                        <p style="display:block; margin-left:30px; color:#29343a; font-weight:400; font-size:10px;"><?php echo 'Email: ' . $reference->email; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- References Ends Here  -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>