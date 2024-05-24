<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
            <th>Última Actualización</th>
            <th>Acciones</th> <!-- Nueva columna para los botones -->
        </tr>
    </thead>
    <tbody>
        @foreach ($socios as $socio)
        <tr>
            <td>{{ $socio->nombre_socio }}</td>
            <td>{{ $socio->apellido1_socio }}</td>
            <td>{{ $socio->tlf_socio }}</td>
            <td>{{ $socio->email_socio }}</td>
            <td>{{ $socio->created_at }}</td>
            <td>{{ $socio->updated_at }}</td>
            <td style="display: flex;"> <!-- Utilizar flexbox para los botones -->
                <a href="{{ route('socios.edit', ['id' => $socio->idsocio]) }}" class="btn btn-primary mr-2">Modificar</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmacionModal{{ $socio->idsocio }}">Eliminar</button>
                <!-- Modal -->
                <div class="modal fade" id="confirmacionModal{{ $socio->idsocio }}" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel{{ $socio->idsocio }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmacionModalLabel{{ $socio->idsocio }}">Confirmar eliminación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que quieres eliminar este socio?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <form action="{{ route('socios.eliminar', ['id' => $socio->idsocio]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
</table>

