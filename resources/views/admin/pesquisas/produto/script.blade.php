<script>
    let produto_v = new Vue({
        el: '#produto',
        data: {
            produtos: [
                // {
                //         categoria: {
                //             father: {
                //                 nome: ''
                //             }
                //         }
            ],
            produto: {
                codigo: '',
                nome: '',
                categoria: '',
                subcategoria: '',
            },
            tempo: {
                data: ''
            },
            buscar: {
                pesquisa: ''
            }
        },
        mounted: function() {
            this.index()
        },
        methods: {
            index() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('produto.pesquisa') }}`, '1', {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc.data.produtos)
                    this.produtos = doc.data.produtos

                    this.paginate()
                }).catch(error => console.log(error))
            },
            search() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('produto.pesquisa') }}`, this.produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#produto-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchdata() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('produto.pesquisa') }}`, this.tempo, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#produto-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchtotal() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('produto.pesquisa') }}`, this.buscar, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#produto-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            destroy(id, event) {

                event.target.parentNode.parentNode.className = "d-none"
                let formulario = document.getElementById('formDelete')
                let formData = new FormData(formulario)
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`produto/${id}/destroy`, formData, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc)
                    // event.target.parentNode.parentNode.remove()
                    // this.produtos = doc.data.produtos
                    $('#produto-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            paginate() {
                $(function() {
                    let table = $('#produto-table').DataTable({
                        pageLength: 20,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        //  "dom": 't',
                        //  paging: true
                        //"ajax": './assets/demo/data/table_data.json',
                        /*"columns": [
                            { "data": "name" },
                            { "data": "office" },
                            { "data": "extn" },
                            { "data": "start_date" },
                            { "data": "salary" }
                        ]*/
                    });
                    $('#produto-table').DataTable().remove
                    document.getElementById('produto-table_length').className = "d-none"
                })
            }

        }
    })
</script>
