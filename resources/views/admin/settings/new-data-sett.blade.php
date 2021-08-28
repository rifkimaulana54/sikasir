<tr>
    <td>
        <img src="{{asset('image/'.$setting->logo)}}" style="width: 50px;" class="img-fluid rounded-circle"/>
    </td>
    <td>{{$setting->nama_brand}}</td>
    <td class="text-center">
        <button class="btn btn-primary btn-sm" onclick="editSetting({{$setting->id}})">Edit</button>
    </td>
</tr>