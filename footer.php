<!-- footer -->
<footer>
      
        <!-- Scripts________________________________________________________ -->
        <!-- <script>
        function saveAsPDF() {
            // Get the content section element
            const contentSection = document.getElementById('content-section');
            const resultSection = document.querySelector('.results-container');
            // resultSection.classList.remove('results-container');
            
       

            // Create a configuration object for html2pdf
            var opt = {
            margin:       0,
            filename:     'accountPlanner.pdf',
            // image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 1,scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' },
            // pagebreak: { mode: 'avoid-all', before: '.result-section.conclusion' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(contentSection).save();
        }
    </script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script> -->
  <!--  <script-->
		<!--	src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"-->
		<!--	integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="-->
		<!--	crossorigin="anonymous"-->
		<!--	referrerpolicy="no-referrer"-->
		<!--></script>-->



  <!-- <script>
      AOS.init();
    </script> -->

  

        <!-- Scripts________________________________________________________ -->
        <?php wp_footer(); ?>
    </body>
</html>