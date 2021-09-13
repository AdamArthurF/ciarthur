<script>
    const BASE_URL = "<?= base_url($uri_segment) ?>"
    let $insert

    $(() => {
        /**
        * Keperluan store pengaduan
        */
        // ================================================== //
        $insert = async (form) => {
            loading()
            
            let formData = new FormData(form)
            formData.append(
                await csrf().then(csrf => csrf.token_name),
                await csrf().then(csrf => csrf.hash)
            )

            axios.post(BASE_URL + 'coba', formData)
                .then(res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(err => {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        // html: err.response.data.message,
                        text: err.response.statusText
                    })
                }).then(() => {
                    $('#pengaduan-form').trigger('reset');
                    $('#modal_ubah').modal('hide');
                })
        }

        $('#pengaduan-form').validator({
			disable: false,
			focus: false
		});

        $('#pengaduan-form').submit(function (event) {
            event.preventDefault()
            if (this.checkValidity()) {
                $insert(this)
            }
        })
    })
</script>