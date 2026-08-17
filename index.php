<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dynamic Resume</title>
</head>
<body>




<div class="resume_container">
    
    <?php
    $Fullname = 'Mark Ardel R. Oranza';
    $email = '24ur0395@psu.edu.ph';
    $address = 'Villasis Pangasinan';
    $phone_Number = '+638178922546';
    $parent_Name = 'Rodel N. Oranza';

    $contact_Number = '+639304206685';
    $program = 'BS Information Technology';
    $photo = '<img src="1760089941718.jpg" class="img_Prof" alt="Profile_img">';
    
    $career_Track = '';
    $career_Objective = '';
    $core_Skills = '';

    if ($program == 'BS Information Technology') {
        $career_Track = 'Systems Administrator';


        $career_Objective = "To build a career as a " . $career_Track . " applying my academic foundation to optimize and secure IT infrastructures.";
    } else if ($program == 'Computer Science') {
        $career_Track = 'Software Developer';
        $career_Objective = "To build a career as a " . $career_Track . " applying my programming skills to develop efficient software solutions.";
    } else {
        echo "pls add a degree or check the spelling";
    }

    if ($career_Track == 'Systems Administrator') {
        $core_Skills = 'Linux OS, Apache Server Configuration, Hardware Troubleshooting, Network Architecture';
    } else if ($career_Track == 'Software Developer') {
        $core_Skills = 'PHP, MySQL, Conditional Logic, Object-Oriented Programming'; 
    } else {
        $core_Skills = 'N/A';
    }
    ?>
    <?php echo $photo; ?>
    
    <h1 class="out"><?php echo $Fullname; ?></h1>

    <div class="details">
    <p>Email: <?php echo $email; ?></p>
        <p>Phone Number: <?php echo $phone_Number; ?></p>
        <p>Program: <?php echo $program; ?></p>
    </div>

    <div class="misc_details">
        <div class="detail_list">
            <p><strong>Address:</strong><br> <?php echo $address; ?></p>
        </div>  
        <div class="detail_list">
             <p><strong>Parent Name:</strong> <?php echo $parent_Name; ?></p>
            <p><strong>Parent Contact Number:</strong> <?php echo $contact_Number; ?></p>
        </div>
    </div>
    
    <hr>

      <div class="objective_skills">
        <h2>Career Objective</h2>
        <p><?php echo $career_Objective; ?></p>

        <h2>Technical Skills</h2>
        <p><?php echo $core_Skills; ?></p>
    </div>

</div> 

</body>
</html>