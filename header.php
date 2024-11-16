<!doctype html>
<html>

<head>
  
  

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?>
    </title>
    <!-- Font Awesome CDN via https://fontawesomecdn.com/ -->
    <!-- <script src="https://use.fontawesome.com/f225807e61.js"></script> -->
    <!-- <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <!-- font -->
    <!-- <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <?php if ($post->ID == 21737) { echo '<meta name="robots" content="noindex,nofollow">'; } ?>
    <!-- <script src="https://use.fontawesome.com/f225807e61.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        function saveAsPDF() {
            
            const heading = document.getElementById('heading');
            heading.style.display = 'none';
            const search = document.getElementById('top-search');
            search.style.display = 'none';
            
            const element = document.getElementById('download-report-container');
            const download_report_container = document.getElementById('download-report-container');
            download_report_container.style.display = 'block';
            
             
     
          html2pdf(element, {
            margin: [0, 0.2],
            filename: 'Generative-ai-report.pdf',
            html2canvas: { scale: 2 ,bottom:20,top:20},
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            pagebreak: {  mode: ['avoid-all', 'css', 'legacy'] }
          });
    
         setTimeout(function(){
            download_report_container.style.display = 'none';
            search.style.display = 'flex';
            heading.style.display = 'block';


         },1000);
    
    
        }
  </script>
        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.css" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body>
 