<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    // 通用request方法 (class FormRequest extends Request)
    //$request->input('field')          取得輸入欄位
    //$request->all()                   取得所有輸入資料
    //$request->only([...])             只取某些欄位
    //$request->except([...])	        排除某些欄位
    //$request->has('field')	        是否有該欄位
    //$request->file('photo')       	取得上傳檔案
    //$request->method()                取得 HTTP 方法（如 POST）
    //$request->user()                  取得目前登入的使用者(App\Models\User)
    //$request->ip()                    取得 IP
    //$request->header('User-Agent')	取得指定 header
    //$request->bearerToken()	        取得 Bearer Token
    //$request->route('id')	            取得路由參數
    //$request->query('page')	        取得 query string

    // FormRequest 專有方法
    //$request->validated()             ✅ 取得所有通過驗證的欄位（array）
    //$request->safe()                  ✅ 回傳 ValidatedInput 對象，可用 .only() 等方法
    //$request->authorize()             （自訂）是否允許此次請求（常用於權限驗證）
    //$request->rules()                 （自訂）定義驗證規則
    //$request->messages()              （可選）自訂錯誤訊息
    //$request->attributes()            （可選）自訂欄位名稱顯示用詞
    //$request->prepareForValidation()  處理驗證前的輸入（例如合併、格式轉換）
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:150'],
            'body' => ['required','string','min:10'],
            // 'published_at' => ['nullable','date'],
            'tags' => ['nullable','array'],
            'tags.*' => ['integer','exists:tags,id'],
        ];
    }
}
