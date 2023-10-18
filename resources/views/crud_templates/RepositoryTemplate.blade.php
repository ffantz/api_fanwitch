namespace App\Repositories;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\{{$className}};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\RepositoryInterface;

class {{$className}}Repository extends GenericRepository implements RepositoryInterface
{
    public function __construct()
    {
    }

    public static function getClass()
    {
        return {{$className}}::class;
    }

    public static function getPrimaryKeyName() : string
    {
        return (new {{$className}})->getKeyName();
    }
}
