
Route::get('/marchandises/create', [AchatController::class, 'create'])->name('marchandises.create');
Route::post('/marchandises', [AchatController::class, 'store'])->name('marchandises.store');
Route::get('/marchandises/{marchandise}/edit', [AchatController::class, 'edit'])->name('marchandises.edit');
Route::put('/marchandises/{marchandise}', [AchatController::class, 'update'])->name('marchandises.update');
Route::get('/marchandises/destroy/{id}', [AchatController::class, 'destroy'])->name('marchandises.ditory');
Route::get('/marchandises/displayM', [AchatController::class, 'goodsavailable'])->name('marchandises.displayM');
Route::get('/marchandises/{marchandise}/detail', [AchatController::class, 'detail'])->name('marchandises.detail');
Route::get('/marchandises/printlist', [AchatController::class, 'displayprint'])->name('marchandises.printlist');
Route::get('/generatePDF', [PdfController::class, 'generatePDF'])->name('generatePDF');
Route::get('/marchandises/{id}', [AchatController::class, 'show']);

