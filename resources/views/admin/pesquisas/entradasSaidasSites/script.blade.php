<script>
    var data = new Date();
    var dia = String(data.getDate()).padStart(2, '0');
    var mes = String(data.getMonth() + 1).padStart(2, '0');
    var ano = data.getFullYear();
    dataAtual = dia + '-' + mes + '-' + ano;
    let entrada_saida_v = new Vue({
        el: '#entradas-saidas-sites',
        data: {
            produtos: [],
            produto: {
                codigo: '',
                nome: '',
                categoria: '',
                subcategoria: '',
                site: '',
                datainicio: moment(new Date()).subtract(1, 'months').format('YYYY-MM-DD'),
                datafim: moment(new Date()).format("YYYY-MM-DD"),
                pesquisa: ''
            },
            loding: false, 
        },
        mounted: function() {
            this.index()
        },
        methods: {
            index() {
                const csrfToken = document.getElementsByName('_token')[0].value;

                axios.post(`{{ route('stockfilter.sites.pesquisa') }}`, this.produto, {
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
                this.produtos = []
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stockfilter.sites.pesquisa') }}`, this.produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    this.produtos = []
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#entradasSaidasSites-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchdata() {
                this.produtos = []
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stockfilter.sites.pesquisa') }}`, this.produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    this.produtos = []
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#entradasSaidasSites-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            },
            searchtotal() {
                this.produtos = []
                const csrfToken = document.getElementsByName('_token')[0].value;
                axios.post(`{{ route('stockfilter.sites.pesquisa') }}`, this.produto, {
                    headers: {
                        "X-CSRF-Token": csrfToken
                    }
                }).then(doc => {
                    this.produtos = []
                    // console.log(doc)
                    this.produtos = doc.data.produtos
                    $('#entradasSaidasSites-table').DataTable().destroy();
                    this.paginate()
                }).catch(error => console.log(error))
            }, 
            formatarData(data) {
                let current = moment(data).format('DD-MM-YYYY')
                // console.log(current)
                return current
            }


        }
    })
</script>
