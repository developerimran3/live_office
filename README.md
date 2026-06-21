## Recent Trading Agency

# Bill Generate — Setup নির্দেশিকা

## ফাইল কোথায় রাখবেন

| ফাইল                           | গন্তব্য                                                 |
| ------------------------------ | ------------------------------------------------------- |
| `BillGenerateForm.php`         | `app/Http/Livewire/BillGenerateForm.php`                |
| `PortRate.php`                 | `app/Models/PortRate.php`                               |
| `BillGenerate.php`             | `app/Models/BillGenerate.php`                           |
| `bill-generate-form.blade.php` | `resources/views/livewire/bill-generate-form.blade.php` |

> যদি আপনি Livewire v3 ব্যবহার করেন, তাহলে component-এর namespace `App\Http\Livewire` থেকে `App\Livewire`-এ পরিবর্তন করতে হবে, এবং `wire:model.debounce.500ms` সিনট্যাক্স বদলে `wire:model.live.debounce.500ms` করতে হবে।

## যেকোনো Blade পেজে component বসাবেন কিভাবে

```blade
@livewire('bill-generate-form')
```

## কাজের ধরন (লজিক সারসংক্ষেপ)

1. **W/R DT ও ADO DT** অটোমেটিক সেট হয় `cl_date` বা `unstf_date`-এর +3 দিন পর হিসেবে। দুটোর যেটা সবার শেষে পরিবর্তন হবে, সেটার ভিত্তিতেই `wr_date` রিফ্রেশ হবে।
2. **DAYS** এখন `wr_date` থেকে `upto_date` পর্যন্ত গণনা হয় (আগে `cl_date` ভিত্তিক ছিল, এখন আপডেট হয়েছে)।
3. **Save Bill** ক্লিক করলে `createEnty()` মেথড চলে —
    - ভ্যালিডেশন করে (`upto_date` অবশ্যই `wr_date`-এর সমান বা পরের হতে হবে)
    - `port_rates` টেবিল থেকে rate config আনে (প্রথম রো — `PortRate::first()`)
    - কন্টেইনার টাইপ (`20fcl` / `40fcl` / `lockfast` / `warehouse`) ও DG status অনুযায়ী সঠিক rate column বেছে নেয়
    - DAYS-কে **1st (1–7 দিন) / 2nd (8–20 দিন) / 3rd (21+ দিন)** পিরিয়ডে ভাগ করে storage charge হিসাব করে
    - River Dues, Lift On, Extra Movement, RPC, HC, Unstuffing — প্রতিটির জন্য আলাদা লাইন তৈরি করে
    - প্রতিটি লাইনে **PORT (TK)**, তার উপর **VAT 15%**, **MLWF 0.40%** যুক্ত করে TOTAL বানায়
    - সবকিছু `$billLines` array-এ রাখে, যা টেবিলে রেন্ডার হয়
    - একই সাথে `bill_generates` টেবিলে এন্ট্রি সেভ করে

## আপনার যেটা পরিবর্তন করা লাগতে পারে

- **VAT/MLWF rate**: কম্পোনেন্টের শুরুতে `$vatPercent = 15;` এবং `$mlwfPercent = 0.40;` — এখানে বদলান।
- **Storage period breakpoints**: এখন 1st=7 দিন, 2nd=13 দিন (অর্থাৎ 8-20), বাকিটা 3rd। `splitDaysIntoPeriods($days, 7, 13)` কলের সংখ্যা বদলে নিজের পোর্টের তারিফ অনুযায়ী সেট করুন।
- **একাধিক rate card** যদি ভবিষ্যতে লাগে (যেমন বছর/মৌসুম ভেদে আলাদা rate), তখন `portRate()` মেথডে `PortRate::first()`-এর জায়গায় dropdown থেকে নির্বাচিত আইডি ব্যবহার করতে হবে।

## টেস্ট করার আগে

```bash
php artisan migrate
php artisan tinker
>>> App\Models\PortRate::create([]); // default ভ্যালু দিয়ে একটা রো তৈরি করবে
```

কোনো rate ছাড়া ফর্ম সাবমিট করলে "Port rate configuration not found" এরর দেখাবে — তাই আগে অন্তত একটা `port_rates` রো থাকা জরুরি।
