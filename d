[1mdiff --git a/app/Http/Controllers/ProjectController.php b/app/Http/Controllers/ProjectController.php[m
[1mindex 862651c..89f403f 100644[m
[1m--- a/app/Http/Controllers/ProjectController.php[m
[1m+++ b/app/Http/Controllers/ProjectController.php[m
[36m@@ -6,6 +6,7 @@[m
 use Illuminate\Http\Request;[m
 use Illuminate\Http\RedirectResponse;[m
 use Illuminate\View\View;[m
[32m+[m[32muse Illuminate\Support\Facades\Auth;[m
 [m
 class ProjectController extends Controller[m
 {[m
[36m@@ -14,7 +15,11 @@[m [mclass ProjectController extends Controller[m
      */[m
     public function index(): View[m
     {[m
[31m-        $projects = Project::latest()->paginate(10);[m
[32m+[m[32m        // Hanya tampilkan project milik user yang sedang login[m
[32m+[m[32m        $projects = Project::where('user_id', Auth::id())[m
[32m+[m[32m                          ->latest()[m
[32m+[m[32m                          ->paginate(10);[m
[32m+[m
         return view('projects.index', compact('projects'));[m
     }[m
 [m
[36m@@ -36,9 +41,11 @@[m [mpublic function store(Request $request): RedirectResponse[m
             'description' => 'required|string',[m
         ]);[m
 [m
[32m+[m[32m        // Tambahkan user_id saat membuat project baru[m
         Project::create([[m
             'name' => $request->name,[m
             'description' => $request->description,[m
[32m+[m[32m            'user_id' => Auth::id(),[m
         ]);[m
 [m
         return redirect()->route('projects.index')[m
[36m@@ -48,9 +55,23 @@[m [mpublic function store(Request $request): RedirectResponse[m
     /**[m
      * Display the specified resource.[m
      */[m
[31m-    [m
[32m+[m[32m    public function show(Project $project): View[m
[32m+[m[32m    {[m
[32m+[m[32m        // Pastikan user hanya bisa melihat project miliknya[m
[32m+[m[32m        if ($project->user_id !== Auth::id()) {[m
[32m+[m[32m            abort(403, 'Unauthorized access to this project.');[m
[32m+[m[32m        }[m
[32m+[m
[32m+[m[32m        return view('projects.show', compact('project'));[m
[32m+[m[32m    }[m
[32m+[m
     public function edit(Project $project): View[m
     {[m
[32m+[m[32m        // Pastikan user hanya bisa edit project miliknya[m
[32m+[m[32m        if ($project->user_id !== Auth::id()) {[m
[32m+[m[32m            abort(403, 'Unauthorized access to this project.');[m
[32m+[m[32m        }[m
[32m+[m
         return view('projects.edit', compact('project'));[m
     }[m
 [m
[36m@@ -59,6 +80,11 @@[m [mpublic function edit(Project $project): View[m
      */[m
     public function update(Request $request, Project $project): RedirectResponse[m
     {[m
[32m+[m[32m        // Pastikan user hanya bisa update project miliknya[m
[32m+[m[32m        if ($project->user_id !== Auth::id()) {[m
[32m+[m[32m            abort(403, 'Unauthorized access to this project.');[m
[32m+[m[32m        }[m
[32m+[m
         $request->validate([[m
             'name' => 'required|string|max:255',[m
             'description' => 'required|string',[m
[36m@@ -78,9 +104,14 @@[m [mpublic function update(Request $request, Project $project): RedirectResponse[m
      */[m
     public function destroy(Project $project): RedirectResponse[m
     {[m
[32m+[m[32m        // Pastikan user hanya bisa delete project miliknya[m
[32m+[m[32m        if ($project->user_id !== Auth::id()) {[m
[32m+[m[32m            abort(403, 'Unauthorized access to this project.');[m
[32m+[m[32m        }[m
[32m+[m
         $project->delete();[m
 [m
         return redirect()->route('projects.index')[m
             ->with('success', 'Project deleted successfully.');[m
     }[m
[31m-}[m
\ No newline at end of file[m
[32m+[m[32m}[m
[1mdiff --git a/app/Models/Project.php b/app/Models/Project.php[m
[1mindex 4201e3f..3305627 100644[m
[1m--- a/app/Models/Project.php[m
[1m+++ b/app/Models/Project.php[m
[36m@@ -5,6 +5,7 @@[m
 use Illuminate\Database\Eloquent\Factories\HasFactory;[m
 use Illuminate\Database\Eloquent\Model;[m
 use Illuminate\Database\Eloquent\Relations\HasMany;[m
[32m+[m[32muse Illuminate\Database\Eloquent\Relations\BelongsTo;[m
 [m
 class Project extends Model[m
 {[m
[36m@@ -12,15 +13,19 @@[m [mclass Project extends Model[m
 [m
     protected $fillable = [[m
         'name',[m
[31m-        'description'[m
[32m+[m[32m        'description',[m
[32m+[m[32m        'user_id'[m
     ];[m
     public function buildingParts(): HasMany[m
     {[m
         return $this->hasMany(BuildingPart::class);[m
     }[m
[31m-[m
[32m+[m[32mpublic function user(): BelongsTo[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->belongsTo(User::class);[m
[32m+[m[32m    }[m
     protected $casts = [[m
         'created_at' => 'datetime',[m
         'updated_at' => 'datetime',[m
     ];[m
[31m-}[m
\ No newline at end of file[m
[32m+[m[32m}[m
[1mdiff --git a/app/Models/User.php b/app/Models/User.php[m
[1mindex 749c7b7..38f6381 100644[m
[1m--- a/app/Models/User.php[m
[1m+++ b/app/Models/User.php[m
[36m@@ -6,6 +6,7 @@[m
 use Illuminate\Database\Eloquent\Factories\HasFactory;[m
 use Illuminate\Foundation\Auth\User as Authenticatable;[m
 use Illuminate\Notifications\Notifiable;[m
[32m+[m[32muse Illuminate\Database\Eloquent\Relations\HasMany;[m
 [m
 class User extends Authenticatable[m
 {[m
[36m@@ -45,4 +46,12 @@[m [mprotected function casts(): array[m
             'password' => 'hashed',[m
         ];[m
     }[m
[32m+[m
[32m+[m[32m    /**[m
[32m+[m[32m     * Get all projects for this user.[m
[32m+[m[32m     */[m
[32m+[m[32m    public function projects(): HasMany[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->hasMany(Project::class);[m
[32m+[m[32m    }[m
 }[m
[1mdiff --git a/database/migrations/2025_06_09_053341_create_projects_table.php b/database/migrations/2025_06_09_053341_create_projects_table.php[m
[1mindex 5851e88..0afeffa 100644[m
[1m--- a/database/migrations/2025_06_09_053341_create_projects_table.php[m
[1m+++ b/database/migrations/2025_06_09_053341_create_projects_table.php[m
[36m@@ -13,6 +13,7 @@[m [mpublic function up(): void[m
     {[m
         Schema::create('projects', function (Blueprint $table) {[m
             $table->id();[m
[32m+[m[32m            $table->foreignId('user_id')->constrained()->onDelete('cascade');[m
             $table->string('name');[m
             $table->text('description');[m
             $table->timestamps();[m
[36m@@ -26,4 +27,4 @@[m [mpublic function down(): void[m
     {[m
         Schema::dropIfExists('projects');[m
     }[m
[31m-};[m
\ No newline at end of file[m
[32m+[m[32m};[m
[1mdiff --git a/database/seeders/ProjectSeeder.php b/database/seeders/ProjectSeeder.php[m
[1mindex 8342878..e5dcc1a 100644[m
[1m--- a/database/seeders/ProjectSeeder.php[m
[1m+++ b/database/seeders/ProjectSeeder.php[m
[36m@@ -16,6 +16,7 @@[m [mpublic function run(): void[m
         DB::table('projects')->insert([[m
             [[m
                 'id' => 3,[m
[32m+[m[32m                'user_id' => 2,[m
                 'name' => "Lintang's House",[m
                 'description' => "Build Lintang's House in Semarang City",[m
                 'created_at' => '2025-06-09 06:46:27',[m
[36m@@ -23,6 +24,7 @@[m [mpublic function run(): void[m
             ],[m
             [[m
                 'id' => 4,[m
[32m+[m[32m                'user_id' => 2,[m
                 'name' => 'Building an Apartement',[m
                 'description' => 'Building a magnificent apartment in ungaran district',[m
                 'created_at' => '2025-06-09 06:50:21',[m
[36m@@ -30,6 +32,7 @@[m [mpublic function run(): void[m
             ],[m
             [[m
                 'id' => 5,[m
[32m+[m[32m                'user_id' => 2,[m
                 'name' => 'Housing Renovation',[m
                 'description' => 'Project to renovate existing public housing in Pedurungan as subsidized housing.',[m
                 'created_at' => '2025-06-09 06:53:45',[m
[36m@@ -37,4 +40,4 @@[m [mpublic function run(): void[m
             ],[m
         ]);[m
     }[m
[31m-}[m
\ No newline at end of file[m
[32m+[m[32m}[m
[1mdiff --git a/package-lock.json b/package-lock.json[m
[1mindex 74c7178..4d63ff6 100644[m
[1m--- a/package-lock.json[m
[1m+++ b/package-lock.json[m
[36m@@ -1,5 +1,5 @@[m
 {[m
[31m-    "name": "candidate-test-feature-test",[m
[32m+[m[32m    "name": "candidate-test",[m
     "lockfileVersion": 3,[m
     "requires": true,[m
     "packages": {[m
[1mdiff --git a/resources/views/dashboard.blade.php b/resources/views/dashboard.blade.php[m
[1mindex fd39083..18d3008 100644[m
[1m--- a/resources/views/dashboard.blade.php[m
[1m+++ b/resources/views/dashboard.blade.php[m
[36m@@ -5,7 +5,7 @@[m
 [m
 @section('page-actions')[m
     <div class="flex items-center space-x-3">[m
[31m-        <a href="{{ route('projects.index') }}" [m
[32m+[m[32m        <a href="{{ route('projects.index') }}"[m
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium inline-flex items-center">[m
             <i class="fas fa-project-diagram mr-2"></i>[m
             View Projects[m
[36m@@ -96,14 +96,20 @@[m [mclass="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm fon[m
                 <div class="p-6 hover:bg-gray-50 transition-colors duration-150">[m
                     <div class="flex items-start justify-between">[m
                         <div>[m
[31m-                            <h4 class="font-medium text-gray-900">{{ $project->name }}</h4>[m
[31m-                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>[m
[31m-                            <div class="mt-2 flex items-center text-sm text-gray-500">[m
[31m-                                <i class="fas fa-calendar-alt mr-1.5"></i>[m
[31m-                                <span>Created {{ $project->created_at->diffForHumans() }}</span>[m
[31m-                            </div>[m
[31m-                        </div>[m
[31m-                        <a href="{{ route('projects.show', $project) }}" [m
[32m+[m[32m    <h4 class="font-medium text-gray-900">{{ $project->name }}</h4>[m
[32m+[m[32m    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($project->description, 100) }}</p>[m
[32m+[m[32m    <div class="mt-2 space-y-1">[m
[32m+[m[32m        <div class="flex items-center text-sm text-gray-500">[m
[32m+[m[32m            <i class="fas fa-user mr-1.5"></i>[m
[32m+[m[32m            <span>Created by {{ $project->user->name }}</span>[m
[32m+[m[32m        </div>[m
[32m+[m[32m        <div class="flex items-center text-sm text-gray-500">[m
[32m+[m[32m            <i class="fas fa-calendar-alt mr-1.5"></i>[m
[32m+[m[32m            <span>Created {{ $project->created_at->diffForHumans() }}</span>[m
[32m+[m[32m        </div>[m
[32m+[m[32m    </div>[m
[32m+[m[32m</div>[m
[32m+[m[32m                        <a href="{{ route('projects.show', $project) }}"[m
                            class="text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">[m
                             View[m
                             <i class="fas fa-chevron-right ml-1"></i>[m
[36m@@ -146,7 +152,7 @@[m [mclass="text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">[m
                         </p>[m
                     </div>[m
                 </div>[m
[31m-                [m
[32m+[m
                 <div class="flex items-start">[m
                     <div class="flex-shrink-0 mt-1">[m
                         <div class="p-2 rounded-full bg-green-100 text-green-600">[m
[36m@@ -160,7 +166,7 @@[m [mclass="text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">[m
                         </p>[m
                     </div>[m
                 </div>[m
[31m-                [m
[32m+[m
                 <div class="flex items-start">[m
                     <div class="flex-shrink-0 mt-1">[m
                         <div class="p-2 rounded-full bg-purple-100 text-purple-600">[m
[36m@@ -175,13 +181,13 @@[m [mclass="text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">[m
                     </div>[m
                 </div>[m
             </div>[m
[31m-            [m
[32m+[m
             <div class="mt-6 bg-blue-50 rounded-lg p-4">[m
                 <h4 class="text-sm font-medium text-blue-800">Need help?</h4>[m
                 <p class="text-sm text-blue-700 mt-1">[m
                     Check our documentation or contact support if you have any questions.[m
                 </p>[m
[31m-                <a href="https://wa.me/6288290320097" target="_blank" [m
[32m+[m[32m                <a href="https://wa.me/6288290320097" target="_blank"[m
    class="mt-2 text-sm font-medium text-green-600 hover:text-green-800 inline-flex items-center">[m
     Hubungi Saya via WA[m
     <i class="fab fa-whatsapp ml-1"></i>[m
[36m@@ -193,4 +199,4 @@[m [mclass="mt-2 text-sm font-medium text-green-600 hover:text-green-800 inline-flex[m
 </div>[m
 [m
 [m
[31m-@endsection[m
\ No newline at end of file[m
[32m+[m[32m@endsection[m
