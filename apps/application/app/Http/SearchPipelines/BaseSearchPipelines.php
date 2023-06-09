<?php

namespace App\Http\SearchPipelines;

use Closure;
use Illuminate\Support\Str;

abstract class BaseSearchPipelines
{
    public function handle($request, Closure $next)
    {
        // Bypass filter if no param for it or if the value of the param is null
        $param = $this->findParam();
        if (($param === null) && ! request()->has($this->filterName())) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder, $param);
    }

    protected function findParam()
    {
        $snake = Str::snake(class_basename($this));
        if (($param = request($snake)) !== null) {
            return $param;
        }

        $camel = Str::camel(class_basename($this));
        if (($param = request($camel)) !== null) {
            return $param;
        }

        if (! ('sort' === $camel && null !== ($param = request('sortColumn')))) {
            return null;
        }
        // default to id and desc if no sort params, show the latest data first
        if ('' === $param) {
            request()->merge(['sortDirection' => 'desc']);

            return 'id';
        }

        return $param;
    }

    /**
     * get snake case of the class name.
     *
     * @return string
     */
    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }

    abstract protected function applyFilter($builder, $param);

    protected function paramName()
    {
        return Str::snake(class_basename($this));
    }
}
