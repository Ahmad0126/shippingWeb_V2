<?php
namespace Resources\Libraries;

class Notify{
    protected $toast_cfg = '
        positionClass: "toast-bottom-right",
        timeOut: 5e3,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1
    ';

    public function sweet($judul, $pesan, $warna){
        return '
		<script>
            $(document).ready( function () {
                swal({
                    type: "'.$warna.'",
                    title: "'.$judul.'",
                    text: "'.$pesan.'",
                    timer: 4e3
                });
            } );
		</script>';
    }
    
    public function toast_success($pesan){
        return '
		<script>
            toastr.success("'.$pesan.'", "Bottom Right", {'.$this->toast_cfg.'});
		</script>';
    }
    public function toast_error($pesan){
        return '
		<script>
            toastr.error("'.$pesan.'", "Bottom Right", {'.$this->toast_cfg.'});
		</script>';
    }

    public function alert($pesan, $warna){
        return '
		<div class="alert alert-'.$warna.' alert-dismissible fade show notifikasi" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
            <span class="alert-text">'.$pesan.'</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
		</div>';
    }
}