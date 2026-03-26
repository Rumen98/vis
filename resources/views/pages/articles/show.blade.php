@extends('layouts.app')

@section('title', $article->title)

@section('content')
<section class="bg-slate-50">
    <div class="mx-auto max-w-4xl px-4 py-14">
        <a href="{{ route('solutions') }}#articles" class="text-sm text-slate-500 transition hover:text-slate-800">
            ← Назад към статии
        </a>

        <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">
                {{ $article->title }}
            </h1>

            @if ($article->excerpt)
                <p class="mt-4 text-base leading-7 text-slate-600">
                    {{ $article->excerpt }}
                </p>
            @endif

            @if (!empty($article->featured_image))
                <div class="mt-6 overflow-hidden rounded-xl border border-slate-200">
                    <img
                        src="{{ asset('storage/' . $article->featured_image) }}"
                        alt="{{ $article->title }}"
                        class="w-full object-cover"
                        style="aspect-ratio: 16 / 9;"
                        loading="lazy"
                    >
                </div>
            @endif

            <style>
                .article-content {
                    line-height: 1.8;
                    color: #334155;
                    word-break: break-word;
                }

                .article-content > *:first-child {
                    margin-top: 0;
                }

                .article-content > *:last-child {
                    margin-bottom: 0;
                }

                .article-content p {
                    margin: 0 0 1.25rem 0;
                }

                .article-content h2,
                .article-content h3,
                .article-content h4 {
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    font-weight: 800;
                    line-height: 1.25;
                    color: #0f172a;
                }

                .article-content h2 {
                    font-size: 1.5rem;
                }

                .article-content h3 {
                    font-size: 1.25rem;
                }

                .article-content h4 {
                    font-size: 1.125rem;
                }

                .article-content ul,
                .article-content ol {
                    margin: 0 0 1.5rem 1.25rem;
                    padding-left: 1rem;
                }

                .article-content li {
                    margin-bottom: 0.5rem;
                }

                .article-content a {
                    color: #dc2626;
                    text-decoration: underline;
                }

                .article-content strong {
                    color: #0f172a;
                    font-weight: 700;
                }

                .article-content blockquote {
                    margin: 1.5rem 0;
                    padding: 0.75rem 0 0.75rem 1rem;
                    border-left: 4px solid #cbd5e1;
                    color: #475569;
                    background: #f8fafc;
                    border-radius: 0.5rem;
                }

                .article-content img {
                    display: block;
                    width: 100%;
                    height: auto;
                    margin: 1.5rem 0;
                    border-radius: 0.75rem;
                    border: 1px solid #e2e8f0;
                }

                .article-content figure {
                    margin: 1.5rem 0;
                }

                .article-content figure img {
                    margin: 0;
                }

                .article-content figcaption {
                    margin-top: 0.75rem;
                    font-size: 0.875rem;
                    color: #64748b;
                    text-align: center;
                }

                .article-content iframe {
                    width: 100%;
                    min-height: 400px;
                    border: 0;
                    border-radius: 0.75rem;
                    margin: 1.5rem 0;
                }

                .article-content table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 1.5rem 0;
                    overflow: hidden;
                    border-radius: 0.75rem;
                    border: 1px solid #e2e8f0;
                }

                .article-content th,
                .article-content td {
                    border: 1px solid #e2e8f0;
                    padding: 0.75rem;
                    text-align: left;
                }

                .article-content th {
                    background: #f8fafc;
                    color: #0f172a;
                    font-weight: 700;
                }

                .article-content hr {
                    margin: 2rem 0;
                    border: 0;
                    border-top: 1px solid #e2e8f0;
                }

                .article-content code {
                    background: #f1f5f9;
                    padding: 0.15rem 0.35rem;
                    border-radius: 0.35rem;
                    font-size: 0.9em;
                }

                .article-content pre {
                    margin: 1.5rem 0;
                    background: #0f172a;
                    color: #e2e8f0;
                    padding: 1rem;
                    border-radius: 0.75rem;
                    overflow-x: auto;
                }

                .article-content pre code {
                    background: transparent;
                    padding: 0;
                    color: inherit;
                }
            </style>

            <div class="article-content mt-8 max-w-none">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</section>
@endsection