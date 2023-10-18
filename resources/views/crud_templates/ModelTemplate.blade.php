namespace App\Models;
/**
 * If this model has a composite primary key, use the trait HasCompositePrimaryKey, uncommenting the following lines:
 * * use \LaravelTreats\Model\Traits\HasCompositePrimaryKey;
 * * use HasCompositePrimaryKey;
 */
// use App\Models\Traits\HasCompositePrimaryKey;

class {{$className}}
{
    use Uuid;
    // use HasCompositePrimaryKey;

    protected $table = '{{ $tableName }}';
    protected $guarded = ['id'];
    // public $incrementing = false;
    // public $timestamps = false;
    // protected $primaryKey = [];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // "name",
    ];
}