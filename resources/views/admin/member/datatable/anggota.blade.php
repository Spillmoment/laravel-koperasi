<div class="btn-group">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" id="action' .  $item->id . '"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi
        </button>
        <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
            <a class="dropdown-item" href="' . route('anggota.edit', $item->id) . '">
                Sunting
            </a>
            <form action="' . route('anggota.destroy', $item->id) . '" method="POST">
                ' . method_field('delete') . csrf_field() . '
                <button type="submit" class="dropdown-item text-danger">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>;
