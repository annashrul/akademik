</div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="<?=base_url('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!-- FastClick -->
    <script src="<?=base_url('assets/admin/vendors/fastclick/lib/fastclick.js')?>"></script>
    <!-- NProgress -->
    <script src="<?=base_url('assets/admin/vendors/nprogress/nprogress.js')?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url('assets/admin/vendors/moment/min/moment.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="<?=base_url('assets/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
    <!-- iCheck -->
    <!-- Latest compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> -->

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script> -->

    <!-- morris.js -->
    <script src="<?=base_url('assets/admin/vendors/raphael/raphael.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/morris.js/morris.min.js')?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url('assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')?>"></script>
   
    <script src="<?=base_url('assets/admin/vendors/iCheck/icheck.min.js')?>"></script>
    <!-- Datatables -->
    <script src="<?=base_url('assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/jszip/dist/jszip.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/pdfmake/build/pdfmake.min.js')?>"></script>
    <script src="<?=base_url('assets/admin/vendors/pdfmake/build/vfs_fonts.js')?>"></script>
    <!-- validator -->
    <script src="<?=base_url('assets/admin/vendors/validator/validator.js')?>"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url('assets/admin/build/js/custom.min.js')?>"></script>
    
    <script src="<?php echo base_url().'assets/admin/tambahan/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/admin/tambahan/jquery.price_format.min.js'?>"></script>
    
    
    <script type="text/javascript">
      
      $(function(){
        $('#uang').priceFormat({
          prefix: '',
          centsSeparator: '',
          centsLimit: 0,
          thousandsSeparator: ','
        });
        $('#biaya').priceFormat({
          prefix: '',
          centsSeparator: '',
          centsLimit: 0,
          thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
          prefix: '',
          centsSeparator: '',
          centsLimit: 0,
          thousandsSeparator: ','
        });
        
      });
    </script>

    <script type="text/javascript">
        $(".alert-message").delay('10000').slideUp('slow');
    </script>

    
  </body>
</html>