let id = document.getElementById('clienteEndereco').value
const csrfToken = document.getElementsByName('_token')[0].value;
// proposta/cliente/{id}
axios.get(`/proposta/cliente/${id}`, {
    headers: {
        "X-CSRF-Token": csrfToken
    }
}).then(doc => {
    console.log(doc)
    document.getElementById('endereco').value = doc.data.cliente.endereco1
    document.getElementById('nuit').value = doc.data.cliente.nuit
    
    // doc.cliente.endereco1

}).catch(error => {
    // console.log(error.response)
    // this.errors = error.response.data.errors
})



document.getElementById('clienteEndereco').onchange = function () {
    console.log(document.getElementById('clienteEndereco').value)
    let id = document.getElementById('clienteEndereco').value
    const csrfToken = document.getElementsByName('_token')[0].value;
    // proposta/cliente/{id}
    axios.get(`/proposta/cliente/${id}`, {
        headers: {
            "X-CSRF-Token": csrfToken
        }
    }).then(doc => {
        console.log(doc)
        document.getElementById('endereco').value = doc.data.cliente.endereco1
        document.getElementById('nuit').value = doc.data.cliente.nuit
        // doc.cliente.endereco1

    }).catch(error => {
        console.log(error.response)
        // this.errors = error.response.data.errors
    })
}


