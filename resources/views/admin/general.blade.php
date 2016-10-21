@extends('admin.layouts.master')

@section('title', 'Genaral')

@section('sidebar')
@parent

@endsection

@section('content')

@include ('admin.layouts.optionform',['options'=>[
	['site_name' , 'Site Name'],
]])

@endsection

