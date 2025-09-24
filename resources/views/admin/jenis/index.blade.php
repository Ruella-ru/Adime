@extends('layouts.admin.master')

@section('jenisActive')
    text-primary
@endsection

@section('content')
    <h1 class="mb-4" style="font-size:x-large">Manajemen Jenis</h1>
    <hr><br>

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                {{-- Form Pencarian --}}
                <form action="{{ route('admin.jenis.index') }}" method="GET" class="d-flex me-3">
                    <input type="text" name="search" class="form-control form-control-sm me-2"
                        placeholder="Cari Kategori..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                        Cari
                    </button>
                    @if (request('search') !== null)
                        <a href="{{ route('admin.jenis.index') }}" class="btn btn-sm btn-outline-danger ms-2">
                            Reset
                        </a>
                    @endif
                </form>

                <a href="{{ route('admin.jenis.create') }}" class="btn btn-sm btn-primary px-3">
                    <i class="fas fa-plus me-1"></i> Tambah Jenis
                </a>
            </div>

            <div class="row gx-4">
                <div class="col-lg-8 mb-3">
                    @if ($jenis->isEmpty())
                        <div class="alert alert-warning text-center" role="alert">
                            Tidak ada jenis yang ditemukan.
                        </div>
                    @else
                        <table class="table table-bordered table-striped small">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No.</th>
                                    <th>Jenis</th>
                                    <th>Jumlah Product</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis as $val)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}
                                        </td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->products->count() }} Produk</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.jenis.edit', $val->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.jenis.destroy', $val->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jenis ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $jenis->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            Grafik Product
                        </div>
                        <div class="card-body">
                            <div id="myChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                fontFamily: 'inherit',
                height: 300,
            },
            series: [
                @foreach ($jenis as $val)
                    {{ $val->products->count()}},
                @endforeach
            ],
            labels: [
                @foreach ($jenis as $val)
                    "{{ $val->name }}",
                @endforeach
            ],
            dataLabels: {
                enabled: false
            },
        };

        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
    </script>
@endpush
