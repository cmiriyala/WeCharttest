<div class="container-fluid" style="padding-left: 0px">
    <div class="row">
        <div class="col-sm-12">
            <h3>Results:</h3>
            @if(!count($results)>0)
            
            @else
            <textarea id="results" name="results" rows="3" style="width: 100%;display: block" readonly>{{$results[0]->value}}</textarea>
            @endif 
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-gray">
                    <th>List of Ordered Medications</th>
                    <th colspan="20">Dosage</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($medications as $medicine)
                    <tr>
                        <td><p>{{$medicine->value}}</p></td>
                        <td><p>{{$medicine->dosage}}</p></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="bg-gray">
                            <th>List of Ordered Labs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labs as $lab)
                        <tr>
                            <td><p>{{$lab->value}}</p></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">    
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="bg-gray">
                            <th>List of Ordered Procedures</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($procedures as $procedure)
                        <tr>
                            <td><p>{{$procedure->value}}</p></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">    
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="bg-gray">
                            <th>List of Ordered Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $image)
                        <tr>
                          	<td><p>{{$image->value}}</p></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
