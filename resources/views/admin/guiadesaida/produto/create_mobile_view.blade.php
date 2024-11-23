@extends('layout.master')


@section('content')
    <div class="page-content fade-in-up" id="root">
        <div class="row ">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; font-size: 11px">
                            Registo diário: - {{ date('d-m-Y') }} | <i class="fa fa-sign-out"></i>
                            {{ $baixada_info->provincia . '- ' . $baixada_info->distrito . ' - ' . $baixada_info->matricula }}
                        </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body ">
                        <section>

                            <form action="{{ route('guiasaidaproduto.mobile_store') }}" method="post" class="pt-4">

                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail4" style="font-weight: 800">Cliente <i class="text-danger" style="font-size: 12px">*</i></label>
                                        <input required style="border-radius: 7px;" type="text" class="form-control"
                                            placeholder="Ex: Edson Cortez" name="cliente" value="{{ old('cliente') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="distrito_id">Distrito <i class="text-danger" style="font-size: 12px">*</i></label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control distrito_id br custom_select" name="distrito_id">
                                            @foreach ($distritos as $distr)
                                                <option value="{{ $distr->id }}">{{ $distr->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div> 

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputPassword4">Bairro <i class="text-danger" style="font-size: 12px">*</i></label>
                                        <input required style="border-radius: 7px;" type="text"
                                            class="form-control bairro" placeholder="Ex: Malhangalene" value="{{ old('bairro') }}" name="bairro">
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Nº de Contador <i class="text-danger" style="font-size: 12px">*</i></label>
                                        <input required style="border-radius: 7px;" type="number"
                                            class="form-control contador" placeholder="-" value="{{ old('contador') }}" name="contador">
                                    </div>
  
                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Caixa de 2 Mod.</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control caixa_sup_post_v2" name="caixa_sup_post_v2">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Caixa de 4 Mod.</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control caixa_sup_post_v4" name="caixa_sup_post_v4">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputPassword4">Quadrelec</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control quadro_electrico" name="quadro_electrico">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                    </div> 


                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputState">C. abc 2*10mm2</label>
                                        <input style="border-radius: 7px;" type="number"
                                            class="form-control cabo_abc_2_10" placeholder="-" value="{{ old('cabo_abc_2_10') }}" name="cabo_abc_2_10">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">C. abc 4*16mm2</label>
                                        <input style="border-radius: 7px;" type="number" class="form-control cabo_abc_4_16"
                                            placeholder="-" value="{{ old('cabo_abc_4_16') }}" name="cabo_abc_4_16">
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Ligadores PC1</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control ligadores_pc1" name="ligadores_pc1">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Ligadores PC2</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control ligadores_pc2" name="ligadores_pc2">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputPassword4">Pincas 2*16</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control pinca_2_16" name="pinca_2_16">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputPassword4">Pincas 4*16</label>
                                        <select style="border-radius: 7px;" type="text"
                                            class="form-control pinca_4_16" name="pinca_4_16">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
 

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputState">Coordenadas <i class="text-danger" style="font-size: 12px">*</i></label>
                                        <input style="border-radius: 7px;" type="text" class="form-control coordenadas" id="coordenadas"
                                        placeholder="Ex: 4850171*5064782" value="{{ old('coordenadas') }}" name="coordenadas">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Contacto</label>
                                        <input style="border-radius: 7px;"  type="text"
                                            class="form-control contacto" placeholder="Ex: 871234567" value="{{ old('contacto') }}" name="contacto">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label style="font-weight: 800" for="inputCity">Tecnico</label>
                                        <input  style="border-radius: 7px;" type="text"
                                            class="form-control tecnico" placeholder="-" value="{{ old('tecnico') }}" name="tecnico">
                                    </div>
                                </div>
                                
                                <hr>
                                <button type="submit" class="btn btn-success btn-sm btn-rounded pl-4 pr-4">Registar <i
                                    class="fa fa-check"></i>
                                </button> 
                            </form>

                        </section>
 

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
