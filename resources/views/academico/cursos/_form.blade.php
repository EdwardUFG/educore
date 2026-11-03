<div class="space-y-5">
    <label class="block text-sm font-medium text-slate-700">
        Código
        <input name="codigo" value="{{ old('codigo', $curso?->codigo) }}" required maxlength="20" class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
        @error('codigo')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>

    <label class="block text-sm font-medium text-slate-700">
        Nombre
        <input name="nombre" value="{{ old('nombre', $curso?->nombre) }}" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
        @error('nombre')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>

    <label class="block text-sm font-medium text-slate-700">
        Descripción
        <textarea name="descripcion" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">{{ old('descripcion', $curso?->descripcion) }}</textarea>
        @error('descripcion')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>

    <label class="block text-sm font-medium text-slate-700">
        Carrera
        <select name="carrera_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="">Selecciona una carrera</option>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}" @selected(old('carrera_id', $curso?->carrera_id) == $carrera->id)>{{ $carrera->nombre }}</option>
            @endforeach
        </select>
        @error('carrera_id')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>

    <label class="block text-sm font-medium text-slate-700">
        Ciclo
        <select name="ciclo_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="">Selecciona un ciclo</option>
            @foreach ($ciclos as $ciclo)
                <option value="{{ $ciclo->id }}" @selected(old('ciclo_id', $curso?->ciclo_id) == $ciclo->id)>{{ $ciclo->nombre }}</option>
            @endforeach
        </select>
        @error('ciclo_id')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>

    <label class="block text-sm font-medium text-slate-700">
        Docente asignado
        <select name="docente_id" required class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="">Selecciona un docente</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}" @selected(old('docente_id', $curso?->docente_id) == $docente->id)>{{ $docente->name }}</option>
            @endforeach
        </select>
        @error('docente_id')<span class="mt-1 block text-sm text-rose-700">{{ $message }}</span>@enderror
    </label>
</div>
