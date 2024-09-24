<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" wire:model="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" wire:model="direccion" class="form-control">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" wire:model="telefono" class="form-control">
        </div>
        <div class="form-group">
            <label for="ciclo_lectivo">Ciclo Lectivo</label>
            <input type="number" id="ciclo_lectivo" wire:model="ciclo_lectivo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="monto_cooperadora">Monto Cooperadora</label>
            <input type="number" id="monto_cooperadora" wire:model="monto_cooperadora" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label for="hora_inicio_escuela">Hora Inicio Escuela</label>
            <input type="text" id="hora_inicio_escuela" wire:model="hora_inicio_escuela" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hora_fin_escuela">Hora Fin Escuela</label>
            <input type="text" id="hora_fin_escuela" wire:model="hora_fin_escuela" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipo_evaluacion">Tipo De Evaluación</label>
            <select id="tipo_evaluacion" wire:model="tipo_evaluacion" class="form-control" required>
                <option value="numerica">Numérica</option>
                <option value="letras">Letras</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grados">Grados (JSON)</label>
            <input type="text" id="grados" wire:model="grados" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cooperadora">Cooperadora (JSON)</label>
            <input type="text" id="cooperadora" wire:model="cooperadora" class="form-control">
        </div>
        <div class="form-group">
            <label for="jornadas">Jornadas (JSON)</label>
            <input type="text" id="jornadas" wire:model="jornadas" class="form-control">
        </div>
        <div class="form-group">
            <label for="dias">Días (JSON)</label>
            <input type="text" id="dias" wire:model="dias" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
