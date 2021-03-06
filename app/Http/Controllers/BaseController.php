<?php
namespace App\Http\Controllers;

use App\Entities\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Redirect;
use Response;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

abstract class BaseController extends Controller
{

    protected $resourcePrefix;

    public function index(Request $request)
    {
        $results = $this->newModel()->withDrafts()->orderBy('id', 'DESC');

        if ($request->has('keyword'))
        {
            $results->where('name', 'LIKE', '%' . $request->get('keyword') . '%')->orWhere('id', '=', $request->get('keyword'));
        }

        return view(sprintf('%s.list', $this->resourcePrefix), [
            'results'        => $results->paginate(10),
            'resourcePrefix' => $this->resourcePrefix
        ]);
    }

    public function create()
    {
        return view(sprintf('%s.new', $this->resourcePrefix), ['resourcePrefix' => $this->resourcePrefix]);
    }

    public function edit($modelId)
    {
        $model = $this->newModel()->where('id', '=', $modelId)->first();

        return view(sprintf('%s.edit', $this->resourcePrefix), [
            'model'          => $model,
            'resourcePrefix' => $this->resourcePrefix
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        if ($request->has('id'))
        {
            $model = $this->update($data);
            $this->handleRequestFiles($request, $model);

            return $request->wantsJson() ? Response::json([
                'model'       => $model,
                'status_html' => $model->present()->status_html
            ]) : Redirect::route(sprintf('%s.edit', $this->resourcePrefix), [$model->id]);
        }

        $model = $this->newModel()->create($data);
        $this->handleRequestFiles($request, $model);

        return $request->wantsJson() ? Response::json(['model' => $model]) : Redirect::route(sprintf('%s.edit', $this->resourcePrefix), [$model->id]);
    }

    public function update(array $data): Model
    {
        $model = $this->newModel()->find(array_get($data, 'id'));

        $model->update($data);

        return $model;
    }

    public function handleRequestFiles(Request $request, BaseModel $model)
    {
        if ($model instanceof HasMedia && $request->hasFile($model->mediaField()))
        {
            $model->clearMediaCollection($model->mediaField());
            $model->addMedia($request->file($model->mediaField()))->toCollection($model->mediaField());
        }
    }

    public function destroy($modelId)
    {
        $model = $this->newModel()->find($modelId);
        $model->update(['status' => 9]);

        return Redirect::route(sprintf('%s.list', $this->resourcePrefix));
    }

    abstract protected function newModel();
}