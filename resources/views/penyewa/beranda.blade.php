@extends('layouts.layoutPenyewa')

@section('title', 'SiKos - Temukan Kos Impianmu')

@section('konten')
<!-- Hero Section -->
@include('layouts.components.beranda.section1')

<!-- Features Section -->
@include('layouts.components.beranda.section2')

<!-- Popular Kos Section -->
@include('layouts.components.beranda.section3')

<!-- Testimonial Section -->
@include('layouts.components.beranda.section4')

<!-- CTA Section -->
@include('layouts.components.beranda.section5')
@endsection
