@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.subnav')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header text-center mt-1">
                    <img src="{{asset('img/logos/JAKIM Logo.png')}}" alt="Logo JAKIM" width="45px" height="60px">
                    <h6 class="card-title mt-1"><b>JABATAN KEMAJUAN ISLAM MALAYSIA <br> SLIP KEPUTUSAN PEPERIKSAAN UJIAN PENILAIAN
                            KELAS KAFA (UPKK)</b></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">NAMA CALON</div>
                        <div class="col-lg-1">:</div>
                        <div class="col-lg-7">
                            <p>{{ $student->full_name ? Str::upper($student->full_name) : '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">NO KAD PENGENALAN</div>
                        <div class="col-lg-1">:</div>
                        <div class="col-lg-7">
                            <p>{{ $student->ic ? $student->ic : '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">TAHUN</div>
                        <div class="col-lg-1">:</div>
                        <div class="col-lg-7">
                            <p>{{ $result->year ? $result->year : '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">NAMA PUSAT PEPERIKSAAN</div>
                        <div class="col-lg-1">:</div>
                        <div class="col-lg-7">
                            <p>{{ $examCenters->value ? $examCenters->value : '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered w-100 align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">KOD</th>
                                    <th class="text-center">MATA PELAJARAN</th>
                                    <th class="text-center">GRED</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td class="text-center">{{ $subject->code ? $subject->code : '' }}</td>
                                        <td>{{ $subject->value ? $subject->value : '' }}</td>
                                        @if ($subject->code == 'UPKK01')
                                            <td class="text-center">{{ $result->grade_quran ? $result->grade_quran : '' }}
                                            </td>
                                        @elseif ($subject->code == 'UPKK02')
                                            <td class="text-center">
                                                {{ $result->grade_syariah ? $result->grade_syariah : '' }}</td>
                                        @elseif ($subject->code == 'UPKK03')
                                            <td class="text-center">{{ $result->grade_sirah ? $result->grade_sirah : '' }}
                                            </td>
                                        @elseif ($subject->code == 'UPKK04')
                                            <td class="text-center">{{ $result->grade_adab ? $result->grade_adab : '' }}
                                            </td>
                                        @elseif ($subject->code == 'UPKK05')
                                            <td class="text-center">{{ $result->grade_jawi ? $result->grade_jawi : '' }}
                                            </td>
                                        @elseif ($subject->code == 'UPKK06')
                                            <td class="text-center">
                                                {{ $result->grade_lughah ? $result->grade_lughah : '' }}</td>
                                        @elseif ($subject->code == 'UPKK07')
                                            <td class="text-center">{{ $result->grade_pchi ? $result->grade_pchi : '' }}
                                            </td>
                                        @elseif ($subject->code == 'UPKK08')
                                            <td class="text-center">{{ $result->grade_solat ? $result->grade_solat : '' }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('results-list') }}" class="btn btn-secondary mt-4 w-10">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
