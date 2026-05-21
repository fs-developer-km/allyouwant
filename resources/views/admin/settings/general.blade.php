@extends('admin.layouts.admin')
@section('title','Settings')@section('breadcrumb','General Settings')
@section('content')
<div class="page-header"><div><div class="page-title">⚙️ General Settings</div></div></div>
<div class="card" style="max-width:600px">
  <form action="{{ route('admin.settings.general.update') }}" method="POST">
    @csrf
    <div class="card-header"><div class="card-title">Site Information</div></div>
    <div class="card-body">
      @foreach(['site_name'=>'Site Name','site_tagline'=>'Tagline','site_email'=>'Email','site_phone'=>'Phone','site_address'=>'Address','whatsapp_number'=>'WhatsApp Number'] as $key => $label)
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label">{{ $label }}</label>
        <input type="text" name="{{ $key }}" class="form-control" value="{{ $settings[$key] ?? '' }}">
      </div>
      @endforeach
      <button type="submit" class="btn btn-primary">💾 Save Settings</button>
    </div>
  </form>
</div>
@endsection
