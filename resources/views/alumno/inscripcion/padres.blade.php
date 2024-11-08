@vite(['resources/css/form.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/js/padres.js'])
@livewireScripts
@if ($editable === true)
@livewire('navigation-menu')
@endif
<form action="{{ route('alumno.datos.padres.store') }}" method="POST">
    @csrf
        @foreach(['Padre', 'Madre', 'Tutor'] as $tipo)
        <h2 class="h2 text-left">{{ $tipo }}</h2>
        <div class="padre-group">
            @php
                $currentAdulto = $padres->where('tipo', strtolower($tipo))->first();
                if ($currentAdulto && $currentAdulto->pais_id != null) {
                    $provincias = App\Models\provincia::all();
                    $partidos = App\Models\partido::all();
                    $ciudades = App\Models\ciudad::all();
                }
            @endphp

            <div class="form-row">
                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[apellido]">Apellido:</label>
                    <input type="text" name="{{ strtolower($tipo) }}[apellido]" value="{{ old(strtolower($tipo) . '.apellido', $currentAdulto->apellido ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                </div>

                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[nombre]">Nombre:</label>
                    <input type="text" name="{{ strtolower($tipo) }}[nombre]" value="{{ old(strtolower($tipo) . '.nombre', $currentAdulto->nombre ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[nacionalidad]">Nacionalidad:</label>
                    <select id="nacionalidad" name="{{ strtolower($tipo) }}[nacionalidad]" {{ $editable ? '' : 'disabled' }}>
                        <option value="argentina" {{ old(strtolower($tipo) . '.nacionalidad', $currentAdulto->nacionalidad ?? '') == 'argentina' ? 'selected' : '' }}>Argentina</option>
                        <option value="extranjera" {{ old(strtolower($tipo) . '.nacionalidad', $currentAdulto->nacionalidad ?? '') == 'extranjera' ? 'selected' : '' }}>Extranjera</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[asistio_establecimiento_educacional]">Asistió a establecimiento educacional:</label>
                    <select name="{{ strtolower($tipo) }}[asistio_establecimiento_educacional]" {{ $editable ? '' : 'disabled' }}>
                        <option value="1" {{ (old(strtolower($tipo) . '.asistio_establecimiento_educacional', $currentAdulto->asistio_establecimiento_educacional ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ (old(strtolower($tipo) . '.asistio_establecimiento_educacional', $currentAdulto->asistio_establecimiento_educacional ?? '') == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[nivel_mas_alto]">Nivel más alto:</label>
                    <select name="{{ strtolower($tipo) }}[nivel_mas_alto]" {{ $editable ? '' : 'disabled' }}>
                        <option value="primario" {{ (old(strtolower($tipo) . '.nivel_mas_alto', $currentAdulto->nivel_mas_alto ?? '') == 'primario') ? 'selected' : '' }}>Primario</option>
                        <option value="secundario" {{ (old(strtolower($tipo) . '.nivel_mas_alto', $currentAdulto->nivel_mas_alto ?? '') == 'secundario') ? 'selected' : '' }}>Secundario</option>
                        <option value="terciario" {{ (old(strtolower($tipo) . '.nivel_mas_alto', $currentAdulto->nivel_mas_alto ?? '') == 'terciario') ? 'selected' : '' }}>Terciario</option>
                        <option value="universitario" {{ (old(strtolower($tipo) . '.nivel_mas_alto', $currentAdulto->nivel_mas_alto ?? '') == 'universitario') ? 'selected' : '' }}>Universitario</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="{{ strtolower($tipo) }}[completo_nivel]">¿Completó el nivel?</label>
                    <select name="{{ strtolower($tipo) }}[completo_nivel]" {{ $editable ? '' : 'disabled' }}>
                        <option value="1" {{ (old(strtolower($tipo) . '.completo_nivel', $currentAdulto->completo_nivel ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ (old(strtolower($tipo) . '.completo_nivel', $currentAdulto->completo_nivel ?? '') == 0) ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            @if ($tipo != 'Tutor')
                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[vive]">¿Vive?</label>
                        <select name="{{ strtolower($tipo) }}[vive]" id="{{ strtolower($tipo) }}[vive]" data-tipo="{{ strtolower($tipo) }}" {{ $editable ? '' : 'disabled' }}>
                            <option value="1" {{ (old(strtolower($tipo) . '.vive', $currentAdulto->vive ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ (old(strtolower($tipo) . '.vive', $currentAdulto->vive ?? '') == 0) ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
            @else
                <input type="hidden" value="1" name="tutor[vive]" id="tutor[vive]" data-tipo="tutor">
            @endif
                
            <section class="form-content-{{ strtolower($tipo) }}" style="display: none;">
                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[tipo_documento]">Tipo de documento:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[tipo_documento]" value="{{ old(strtolower($tipo) . '.tipo_documento', $currentAdulto->tipo_documento ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[numero_documento]">Número de documento:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[numero_documento]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.numero_documento', $currentAdulto->numero_documento ?? '') }}" >
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[posesion]">Posesión:</label>
                        <select name="{{ strtolower($tipo) }}[posesion]" {{ $editable ? '' : 'disabled' }}>
                            <option value="" {{ (old(strtolower($tipo) . '.posesion', $currentAdulto->posesion ?? '') == '') ? 'selected' : '' }}>Seleccione</option>
                            <option value="en tramite" {{ (old(strtolower($tipo) . '.posesion', $currentAdulto->posesion ?? '') == 'en tramite') ? 'selected' : '' }}>En trámite</option>
                            <option value="no tiene documento" {{ (old(strtolower($tipo) . '.posesion', $currentAdulto->posesion ?? '') == 'no tiene documento') ? 'selected' : '' }}>No tiene documento</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[domicilio_calle]">Calle:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[domicilio_calle]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.domicilio_calle', $currentAdulto->domicilio_calle ?? '') }}" >
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[domicilio_numero]">Número:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[domicilio_numero]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.domicilio_numero', $currentAdulto->domicilio_numero ?? '') }}" >
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[domicilio_piso]">Piso:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[domicilio_piso]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.domicilio_piso', $currentAdulto->domicilio_piso ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[domicilio_torre]">Torre:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[domicilio_torre]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.domicilio_torre', $currentAdulto->domicilio_torre ?? '') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[domicilio_dpto]">Departamento:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[domicilio_dpto]" {{ $editable ? '' : 'disabled' }} value="{{ old(strtolower($tipo) . '.domicilio_dpto', $currentAdulto->domicilio_dpto ?? '') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="pais-{{ strtolower($tipo) }}">País:</label>
                        <select id="pais-{{ strtolower($tipo) }}" name="{{ strtolower($tipo) }}[pais_id]" data-tipo="{{ strtolower($tipo) }}" {{ $editable ? '' : 'disabled' }}>
                            <option value="">Seleccione un país</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old(strtolower($tipo) . 'pais_id', $currentAdulto->pais_id ?? '') == $pais->id ? 'selected' : '' }}>{{ $pais->pais }}</option>
                            @endforeach
                        </select>
                        @error('pais_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>                
                        
                    <div class="form-group">
                        <label for="provincia-{{ strtolower($tipo) }}">Provincia:</label>
                        <select id="provincia-{{ strtolower($tipo) }}" name="{{ strtolower($tipo) }}[provincia_id]" data-tipo="{{ strtolower($tipo) }}" {{ $editable ? '' : 'disabled' }}>
                            <option value="">Seleccione un país</option>
                            @foreach($provincias as $provincia)
                                <option value="{{ $provincia->id }}" {{ old(strtolower($tipo) . 'provincia_id', $currentAdulto->provincia_id ?? '') == $provincia->id ? 'selected' : '' }}>{{ $provincia->provincia }}</option>
                            @endforeach
                        </select>
                        @error('provincia_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>                
                    <div class="form-group">
                        <label for="partido-{{ strtolower($tipo) }}">Partido:</label>
                        <select id="partido-{{ strtolower($tipo) }}" name="{{ strtolower($tipo) }}[partido_id]" data-tipo="{{ strtolower($tipo) }}" {{ $editable ? '' : 'disabled' }}>
                            <option value="">Seleccione un partido</option>
                            @foreach($partidos as $partido)
                                <option value="{{ $partido->id }}" {{ old(strtolower($tipo) . 'partido_id', $currentAdulto->partido_id ?? '') == $partido->id ? 'selected' : '' }}>{{ $partido->partido }}</option>
                            @endforeach
                        </select>
                        @error('partido_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="ciudad-{{ strtolower($tipo) }}">Ciudad:</label>
                        <select id="ciudad-{{ strtolower($tipo) }}" name="{{ strtolower($tipo) }}[ciudad_id]" {{ $editable ? '' : 'disabled' }}>
                            <option value="">Seleccione una ciudad</option>
                            @foreach($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}" {{ old(strtolower($tipo) . 'ciudad_id', $currentAdulto->ciudad_id ?? '') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->ciudad }}</option>
                            @endforeach
                        </select>
                        @error('ciudad_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>                

                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[telefono]">Teléfono:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[telefono]" value="{{ old(strtolower($tipo) . '.telefono', $currentAdulto->telefono ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[celular]">Celular:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[celular]" value="{{ old(strtolower($tipo) . '.celular', $currentAdulto->celular ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[email]">Email:</label>
                        <input type="email" name="{{ strtolower($tipo) }}[email]" value="{{ old(strtolower($tipo) . '.email', $currentAdulto->email ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[jefe_hogar]">¿Es jefe de hogar?</label>
                        <select name="{{ strtolower($tipo) }}[jefe_hogar]" {{ $editable ? '' : 'disabled' }}>
                            <option value="1" {{ (old(strtolower($tipo) . '.jefe_hogar', $currentAdulto->jefe_hogar ?? '') == 1) ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ (old(strtolower($tipo) . '.jefe_hogar', $currentAdulto->jefe_hogar ?? '') == 0) ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[profesion]">Profesión:</label>
                        <input type="text" name="{{ strtolower($tipo) }}[profesion]" value="{{ old(strtolower($tipo) . '.profesion', $currentAdulto->profesion ?? '') }}" {{ $editable ? '' : 'disabled' }}>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="{{ strtolower($tipo) }}[condicion_actividad]">Condición de actividad:</label>
                        <select name="{{ strtolower($tipo) }}[condicion_actividad]" {{ $editable ? '' : 'disabled' }}>
                            <option value="" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == '') ? 'selected' : '' }}>Seleccione una opcion</option>
                            <option value="solo_trabaja" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'solo_trabaja') ? 'selected' : '' }}>Solo trabaja</option>
                            <option value="trabaja_y_estudia" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'trabaja_y_estudia') ? 'selected' : '' }}>Trabaja y estudia</option>
                            <option value="busca_trabajo_y_estudia" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'busca_trabajo_y_estudia') ? 'selected' : '' }}>Busca trabajo y estudia</option>
                            <option value="solo_busca_trabajo" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'solo_busca_trabajo') ? 'selected' : '' }}>Solo busca trabajo</option>
                            <option value="trabaja_y_recibe_jubilacion" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'trabaja_y_recibe_jubilacion') ? 'selected' : '' }}>Trabaja y recibe jubilación</option>
                            <option value="busca_trabajo_y_recibe_jubilacion" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'busca_trabajo_y_recibe_jubilacion') ? 'selected' : '' }}>Busca trabajo y recibe jubilación</option>
                            <option value="jubilado_pensionado" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'jubilado_pensionado') ? 'selected' : '' }}>Jubilado/Pensionado</option>
                            <option value="solo_estudia" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'solo_estudia') ? 'selected' : '' }}>Solo estudia</option>
                            <option value="otro" {{ (old(strtolower($tipo) . '.condicion_actividad', $currentAdulto->condicion_actividad ?? '') == 'otro') ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                </div>
            </section>
        </div>
    <x-section-border/>
    @endforeach
    @if ($editable === true)
    <div class="flex items-center justify-between">
        <x-a href="{{ route('alumno.datos.form5', $inscripcion ?? null) }}">Anterior</x-a>
        <div class="flex items-center justify-end">
            <x-button>Siguente</x-button>
        </div>
    </div>
    @endif
</form>