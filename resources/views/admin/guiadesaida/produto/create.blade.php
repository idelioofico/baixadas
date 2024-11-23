@extends('layout.master')
 

@section('content')
    <div class="page-content fade-in-up" id="root">
        <div class="row ">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">
                            Daily sheet Baixadas - {{ $data }} |  <i class="fa fa-sign-out"></i>
                            {{ $baixada_info['provincia'] .'- '. $baixada_info['distrito'] .' - '. $baixada_info['veiculo']  }}
                        </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body ">
                        <section>
                            <div class="" style="overflow-x:auto;">

                                <table class="table table-hover table-dashed table-striped table-bordered ">
                                    @csrf()
                                
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                            <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Caixas de Proteção</th>
                                            <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                            <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Cabos</th>
                                            <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Ligadores</th>
                                            <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Pinças</th>
                                            <th colspan="4" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                        </tr>
                                    </thead>
                                
                                    <thead class="thead-default" >
                                        <tr>
                                            <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Cliente</th>
                                            <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Bairro</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Nº de Contador</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Monofasicas</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Trifasicas</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">2 Vias</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">4 Vias</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Quadro Electrico</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Postes Kicker de 6,6m</th> 
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">abc 2*10mm2</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">abc 4*16mm2</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">PC1</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">PC2</th>
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">2*16</th> 
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">4*16</th> 
                                            <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Coordenadas</th> 
                                            <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Contacto</th> 
                                            <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Tecnico</th> 
                                            <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6"></th> 
                                        </tr>
                                    </thead>

                                    @foreach ($registed as $item)
                                        <tr>
    
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text" class="form-control"
                                                disabled value="{{ $item->cliente }}">
                                                <div class="text-danger"></div>
                                            </td>
                                        
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content" type="text"
                                                    class="form-control" disabled value="{{ $item->bairro_id }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 8rem;" type="text"
                                                    class="form-control" disabled value="{{ $item->contador }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control" disabled value="{{ $item->baixada_mono }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control" disabled value="{{ $item->baixada_tri }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control" disabled value="{{ $item->caixa_sup_post_v2 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control" disabled value="{{ $item->caixa_sup_post_v4 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control" disabled value="{{ $item->quadro_electrico }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control" disabled value="{{ $item->kicker_post_66 }}">
                                                <div class="text-danger"></div> 
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control" disabled value="{{ $item->cabo_abc_2_10 }}">
                                                <div class="text-danger"></div> 
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text" class="form-control" disabled
                                                    value="{{ $item->cabo_abc_4_16 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;"  type="text" class="form-control" disabled
                                                    value="{{ $item->ligadores_pc1 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;"  type="text" class="form-control" disabled
                                                    value="{{ $item->ligadores_pc2 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text" class="form-control" disabled
                                                    value="{{ $item->pinca_2_16 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text" class="form-control" disabled
                                                    value="{{ $item->pinca_4_16 }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text" class="form-control" disabled
                                                    value="{{ $item->coordenadas }}">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                                    class="form-control" disabled value="{{ $item->contacto }}">
                                                <div class="text-danger"></div>
                                            </td> 
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                                    class="form-control" disabled value="{{ $item->tecnico }}">
                                                <div class="text-danger"></div>
                                            </td> 

                                            <td class="p-2 mt-1 mb-1 text-center d-flex text-white">
                                                <a class="btn btn-success btn-xs btn-rounded mr-2">
                                                    <i class="fa fa-check"></i>
                                                </a> 
                                            </td>

                                        </tr>
                                    @endforeach

                                    <tbody>
    
                                        <tr>
    
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text" class="form-control"
                                                    placeholder="Ex: Edson Cortez" name="cliente">
                                                <div class="text-danger"></div>
                                            </td>
                                           
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content" type="text"
                                                    class="form-control bairro" placeholder="Ex: Malhangalene" name="bairro">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 8rem;" type="text"
                                                    class="form-control contador" placeholder="-" name="contador">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control baixada_mono" value="1" placeholder="-" name="baixada_mono">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control baixada_tri" value="0" placeholder="-" name="baixada_tri">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control caixa_sup_post_v2" value="0" placeholder="-" name="caixa_sup_post_v2">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control caixa_sup_post_v4" value="0" placeholder="-" name="caixa_sup_post_v4">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control quadro_electrico" value="0" placeholder="-" name="quadro_electrico">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text"
                                                    class="form-control kicker_post_66" value="0" placeholder="-" name="kicker_post_66">
                                                <div class="text-danger"></div> 
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                                    class="form-control cabo_abc_2_10" value="0" placeholder="-" name="cabo_abc_2_10">
                                                <div class="text-danger"></div> 
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" value="0" type="text" class="form-control cabo_abc_4_16"
                                                    placeholder="-" name="cabo_abc_4_16">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" value="0"  type="text" class="form-control ligadores_pc1" placeholder="-" name="ligadores_pc1">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" value="0"  type="text" class="form-control ligadores_pc2"
                                                    placeholder="-" name="ligadores_pc2">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" value="0" type="text" class="form-control pinca_2_16"
                                                    placeholder="-" name="pinca_2_16">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: 3rem;" value="0" type="text" class="form-control pinca_4_16"
                                                    placeholder="-" name="pinca_4_16">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px;" type="text" value="0" class="form-control coordenadas"
                                                    placeholder="-" name="coordenadas">
                                                <div class="text-danger"></div>
                                            </td>
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                                    class="form-control contacto" value="0" placeholder="Ex: 871234567" name="contacto">
                                                <div class="text-danger"></div>
                                            </td> 
                                            <td class="p-2 mt-1 mb-1 text-center">
                                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                                    class="form-control tecnico" placeholder="-" name="tecnico">
                                                <div class="text-danger"></div>
                                            </td> 

                                            <td class="p-2 mt-1 mb-1 text-center d-flex text-white">
                                                <a class="btn btn-info btn-xs btn-rounded mr-2 adicionar">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a> 
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </section>

                        <div class="row mt-5">
                            <div class="col-md-10"></div>
                            <div class="col-md-2" style="text-align: end;">
                                <a href="{{ route('guiasaida.index') }}"
                                    class="btn btn-success btn-sm btn-rounded pl-4 pr-4">Concluir <i
                                        class="fa fa-check"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('javascript')
    <script>
        const guiaId = {!! $site !!}
        const csrfToken = document.getElementsByName('_token')[0].value;
        $(document).ready(function() {
            $('table').on('click', '.adicionar', function(e) {

                let specific_element = this
                let linha = e.currentTarget.parentNode.parentNode
                // console.log(e.currentTarget.parentNode.parentNode.innerHTML)
                linha.children[17].children[0].value
                let errors = {}

                // Remove all errors lines
                linha.children[0].children[1].innerHTML = errors.cliente ?? '';
                linha.children[1].children[1].innerHTML = errors.bairro ?? '';
                linha.children[2].children[1].innerHTML = errors.contador ?? '';
                linha.children[3].children[1].innerHTML = errors.baixada_mono ?? '';
                linha.children[4].children[1].innerHTML = errors.baixada_tri ?? '';
                linha.children[5].children[1].innerHTML = errors.caixa_sup_post_v2 ?? '';
                linha.children[6].children[1].innerHTML = errors.caixa_sup_post_v4 ?? '';
                linha.children[7].children[1].innerHTML = errors.quadro_electrico ?? '';
                linha.children[8].children[1].innerHTML = errors.kicker_post_66 ?? '';   
                linha.children[9].children[1].innerHTML = errors.cabo_abc_2_10 ?? '';
                linha.children[10].children[1].innerHTML = errors.cabo_abc_4_16 ?? '';
                linha.children[11].children[1].innerHTML = errors.ligadores_pc1 ?? '';
                linha.children[12].children[1].innerHTML = errors.ligadores_pc2 ?? '';
                linha.children[13].children[1].innerHTML = errors.pinca_2_16 ?? '';
                linha.children[14].children[1].innerHTML = errors.pinca_4_16 ?? '';
                linha.children[15].children[1].innerHTML = errors.coordenadas ?? '';
                linha.children[16].children[1].innerHTML = errors.contacto ?? '';
                linha.children[17].children[1].innerHTML = errors.tecnico ?? '';
                
                var coluna = {};
                // Dados dos campos
                coluna.cliente = linha.children[0].children[0].value;
                coluna.bairro = linha.children[1].children[0].value;
                coluna.contador = linha.children[2].children[0].value;
                coluna.baixada_mono = linha.children[3].children[0].value;
                coluna.baixada_tri = linha.children[4].children[0].value;
                coluna.caixa_sup_post_v2 = linha.children[5].children[0].value;
                coluna.caixa_sup_post_v4 = linha.children[6].children[0].value;
                coluna.quadro_electrico = linha.children[7].children[0].value;
                coluna.kicker_post_66 = linha.children[8].children[0].value;
                coluna.cabo_abc_2_10 = linha.children[9].children[0].value;
                coluna.cabo_abc_4_16 = linha.children[10].children[0].value; 
                coluna.ligadores_pc1 = linha.children[11].children[0].value; 
                coluna.ligadores_pc2 = linha.children[12].children[0].value; 
                coluna.pinca_2_16 = linha.children[13].children[0].value; 
                coluna.pinca_4_16 = linha.children[14].children[0].value; 
                coluna.coordenadas = linha.children[15].children[0].value; 
                coluna.contacto = linha.children[16].children[0].value;
                coluna.tecnico = linha.children[17].children[0].value;

                let dados = coluna; 

                $.ajax({
                    url: `/baixada/{!! $site !!}/{!! $data !!}/{!! $provincia_id !!}/{!! $distrito_id !!}/{!! $veiculo_id !!}/{!! $lote !!}/produto/store`,
                    method: 'POST',
                    data: JSON.stringify(dados),
                    contentType: 'application/json',
                    headers: {
                        "X-CSRF-Token": csrfToken
                    },
                    success: function(data) {
                         

                        let novaLinha = `<tr>

                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: fit-content;" type="text" class="form-control"
                                    placeholder="Ex: Edson Cortez" name="cliente">
                                <div class="text-danger"></div>
                            </td>
                            
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text"
                                    class="form-control bairro" placeholder="-" name="bairro">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 8rem;" type="text"
                                    class="form-control contador" placeholder="-" name="contador">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text"
                                    class="form-control baixada_mono" value="1" placeholder="-" name="baixada_mono">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text"
                                    class="form-control baixada_tri" value="0" placeholder="-" name="baixada_tri">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                    class="form-control caixa_sup_post_v2" placeholder="-" value="0" name="caixa_sup_post_v2">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                    class="form-control caixa_sup_post_v4" placeholder="-" value="0" name="caixa_sup_post_v4">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text"
                                    class="form-control quadro_electrico" placeholder="-" value="0" name="quadro_electrico">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text"
                                    class="form-control kicker_post_66" placeholder="-" value="0" name="kicker_post_66">
                                <div class="text-danger"></div> 
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text"
                                    class="form-control cabo_abc_2_10" placeholder="-" value="0" name="cabo_abc_2_10">
                                <div class="text-danger"></div> 
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text" value="0" class="form-control cabo_abc_4_16"
                                    placeholder="-" name="cabo_abc_4_16">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text" value="0" class="form-control ligadores_pc1"
                                    placeholder="-" name="ligadores_pc1">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text" value="0" class="form-control ligadores_pc2"
                                    placeholder="-" name="ligadores_pc2">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text" value="0" class="form-control pinca_2_16"
                                    placeholder="-" name="pinca_2_16">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: 3rem;" type="text" value="0" class="form-control pinca_4_16"
                                    placeholder="-" name="pinca_4_16">
                                <div class="text-danger"></div>
                            </td>
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px;" type="text" class="form-control coordenadas"
                                    placeholder="-" name="coordenadas">
                                <div class="text-danger"></div>
                            </td>

                            
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                    class="form-control contacto" placeholder="Ex: 871234567" name="contacto">
                                <div class="text-danger"></div>
                            </td>

                            
                            <td class="p-2 mt-1 mb-1 text-center">
                                <input style="border-radius: 7px; width: fit-content;" type="text"
                                    class="form-control tecnico" placeholder="-" name="tecnico">
                                <div class="text-danger"></div>
                            </td>

                            <td class="p-2 mt-1 mb-1 text-center d-flex text-white">
                                <a class="btn btn-info btn-xs btn-rounded mr-2 adicionar">
                                    <i class="fa fa-plus-circle"></i>
                                </a> 
                            </td>
                            
                        </tr>
                        `

                        $('table').append(novaLinha);
                        linha.children[0].children[0].setAttribute("disabled", true)
                        linha.children[1].children[0].setAttribute("disabled", true)
                        linha.children[2].children[0].setAttribute("disabled", true)
                        linha.children[3].children[0].setAttribute("disabled", true)
                        linha.children[4].children[0].setAttribute("disabled", true)
                        linha.children[5].children[0].setAttribute("disabled", true)
                        linha.children[6].children[0].setAttribute("disabled", true)
                        linha.children[7].children[0].setAttribute("disabled", true)
                        linha.children[8].children[0].setAttribute("disabled", true)
                        linha.children[9].children[0].setAttribute("disabled", true)
                        linha.children[10].children[0].setAttribute("disabled", true)
                        linha.children[11].children[0].setAttribute("disabled", true)
                        linha.children[12].children[0].setAttribute("disabled", true) 
                        linha.children[13].children[0].setAttribute("disabled", true) 
                        linha.children[14].children[0].setAttribute("disabled", true) 
                        linha.children[15].children[0].setAttribute("disabled", true) 
                        linha.children[16].children[0].setAttribute("disabled", true) 
                        linha.children[17].children[0].setAttribute("disabled", true) 

                    },
                    
                    error: function(error) {

                        linha.children[0].children[0].innerHTML = '';
                        linha.children[1].children[0].innerHTML = '';
                        linha.children[2].children[0].innerHTML = '';
                        linha.children[3].children[0].innerHTML = '';
                        linha.children[4].children[0].innerHTML = '';
                        linha.children[5].children[0].innerHTML = '';
                        linha.children[6].children[0].innerHTML =
                        linha.children[7].children[0].innerHTML = '';
                        linha.children[8].children[0].innerHTML = '';
                        linha.children[9].children[0].innerHTML = '';
                        linha.children[10].children[0].innerHTML = '';
                        linha.children[11].children[0].innerHTML = '';
                        linha.children[12].children[0].innerHTML = '';
                        linha.children[13].children[0].innerHTML = '';
                        linha.children[14].children[0].innerHTML = '';
                        linha.children[15].children[0].innerHTML = '';
                        linha.children[16].children[0].innerHTML = '';
                        linha.children[17].children[0].innerHTML = '';
 
                    }
                });
            })
        })
    </script>
     
@endpush
