<script>
    let stock_v = new Vue({
        el: '#stock',
        data: {
            produtos: [],
            produto: {
                codigo: '',
                nome: '',
                categoria: '',
                subcategoria: '',
                empresa: '',
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
                axios.post(`{{ route('stock.pesquisa') }}`, '1', {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    console.log(doc)
                    this.produtos = doc.data.produtos

                    this.paginate()
                }).catch(error => console.log(error))
            },
            search() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stock.pesquisa') }}`, this.produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#stock-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchdata() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stock.pesquisa') }}`, this.tempo, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#stock-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchtotal() {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stock.pesquisa') }}`, this.buscar, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#stock-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            paginate() {
                $(function() {
                    let table = $('#stock-table').DataTable({
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
                    $('#stock-table').DataTable().remove
                    document.getElementById('stock-table_length').className = "d-none"
                })
            },
            produtoTotal(produto) {
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stock.produtototal') }}`, produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    // console.log(doc)
                    // this.produtos = doc.data.produtos
                }).catch(error => console.log(error))
            }


        }
    })
</script>
