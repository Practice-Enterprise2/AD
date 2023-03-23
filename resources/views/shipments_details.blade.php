@extends('layouts.navigation')
<x-app-layout>

    @if(count($shipments) > 0)
    @foreach($shipments as $shipment)
    <div class="text-center">
    <h1 class="text-2xl">Tracking details</h1>
    <p>Package of: <strong>{{$shipment->ShipmentName}}</strong></p>
    <p>Created on: <strong>{{$shipment->ShipmentDate}}</strong></p>
    <p>Delivery on: <strong>{{$shipment->DeliveryDate}}</strong></p>
    <p>Weight of: <strong>{{$shipment->ShipmentWeight}}</strong></p>
    <p>Status: <strong>{{$shipment->Name}}</strong></p>
    </div>
    @endforeach
    @else
    <div class="row">
        <div class="col s12">
            <div class="card">
                <p>No posts found</p>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>