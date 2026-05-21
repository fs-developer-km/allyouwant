@extends('admin.layouts.admin')
@section('title','Delivery Settings')@section('breadcrumb','Delivery Settings')
@section('content')
<div class="page-header"><div><div class="page-title">🚚 Delivery Settings</div></div></div>
<div class="card" style="max-width:500px">
  <form action="{{ route('admin.settings.delivery.update') }}" method="POST">
    @csrf
    <div class="card-body">
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label">Free Delivery Above (₹)</label>
        <input type="number" name="free_delivery_above" class="form-control" value="{{ $settings['free_delivery_above'] ?? 499 }}">
      </div>
      <div class="form-group" style="margin-bottom:14px">
        <label class="form-label">Delivery Charge (₹)</label>
        <input type="number" name="delivery_charge" class="form-control" value="{{ $settings['delivery_charge'] ?? 40 }}">
      </div>
      <button type="submit" class="btn btn-primary">💾 Save</button>
    </div>
  </form>
</div>
@endsection
