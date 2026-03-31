<div class="modal fade" id="EliminarProducto{{$item->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¿Eliminar?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Confirma que desea eliminar a <strong>{{ $item->nombre }}</strong>.
                </div>
                <div class="modal-footer">
                    <form action="{{ route('producto.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>