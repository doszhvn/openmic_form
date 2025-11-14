@extends('layouts.admin')

@section('content')
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Songs</h3>
                        <table class="table table-bordered w-auto">
                            <tr>
                                <td> Все: {{$statistics['all']}} </td>
                                <td> Занято: {{$statistics['busy']}}</td>
                                <td> Свободно: {{$statistics['free']}}</td>
                            </tr>
                        </table>
                        @if(count($songs) > 0)
                            <div>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clearSongsModal">
                                    Очистить
                                </button>
                                @include('admin.song.parts.clear_song')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSongModal">
                                    Добавить песню
                                </button>
                                @include('admin.song.parts.create_song')
                            </div>
                        @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulkSongModal">
                                Выгрузить песни
                            </button>
                            @include('admin.song.parts.bulk_songs')
                        @endif
                    </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 30%;">Name</th>
                            <th style="width: 10%;">Actions</th>
                            <th style="width: 50%;">Singer</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($songs as $song)
                        <tr class="align-middle">
                          <td>{{$song['id']}}</td>
                          <td>{{$song['name']}}</td>
                          <td>
                              <button type="button" class="btn btn-sm btn-warning" title="Редактировать"  data-bs-toggle="modal" data-bs-target="#updateSongModal{{ $song->id }}">
                                  <i class="bi bi-pencil"></i>
                              </button>
                              @include('admin.song.parts.update_song')
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSongModal{{ $song->id }}">
                                  <i class="bi bi-trash"></i>
                              </button>
                              @include('admin.song.parts.delete_song')
                          </td>
                          <td>
                              @if($song['singer'] == null)
                                  <span class="badge text-bg-success">Свободно</span>
                              @else
                                  <div class="d-flex align-items-center gap-3">
                                      <span class="badge text-bg-danger">Занято</span>
                                      <span class="fw-bold">{{ $song['singer']['name'] }}</span>
                                      <span>{{ $song['singer']['phone'] }}</span>
                                      <a href="https://www.instagram.com/{{ $song['singer']['instagram'] }}" target="_blank" class="text-primary">
                                          {{ '@' . $song['singer']['instagram'] }}
                                      </a>
                                      <span>{{ ($song['singer']['created_at'])->format('d.m.Y в h:m') }}</span>
                                  </div>
                              @endif
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            {{-- Кнопка "Назад" --}}
                            <li class="page-item {{ $songs->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $songs->previousPageUrl() ?? '#' }}">&laquo;</a>
                            </li>

                            {{-- Генерация номеров страниц --}}
                            @for ($i = 1; $i <= $songs->lastPage(); $i++)
                                <li class="page-item {{ $i == $songs->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $songs->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Кнопка "Вперед" --}}
                            <li class="page-item {{ $songs->currentPage() == $songs->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $songs->nextPageUrl() ?? '#' }}">&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
              </div>
              <!-- /.col -->
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
@endsection
