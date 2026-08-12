# Security Policy

## Supported versions

This library is under active development. Security fixes are provided for the latest
released minor version, and for the `main` branch.

| Version | Supported          |
| ------- | ------------------ |
| `main`  | :white_check_mark: |
| latest release | :white_check_mark: |
| older   | :x:                |

## Reporting a vulnerability

**Please do not report security vulnerabilities through public GitHub issues.**

Instead, use one of the following private channels:

- GitHub's [private vulnerability reporting](https://github.com/jolicode/structured-data/security/advisories/new)
  (preferred), or
- email **coucou@jolicode.com** with the details.

Please include:

- a description of the vulnerability and its impact,
- the smallest input document or code sample that reproduces it,
- the affected version or commit.

We will acknowledge your report as quickly as we can, keep you informed of the fix
progress, and credit you in the release notes unless you prefer to remain anonymous.

## Scope and threat model

This library processes **untrusted, potentially attacker-controlled documents** (the very
job of a validator is to inspect input you did not write). The following are in scope and
we take them seriously:

- Server-Side Request Forgery through remote `@context` resolution. Remote loading is
  **off by default**; see the "Loading remote contexts" section of the [README](../README.md).
- Denial of service through hostile documents (deeply nested input, oversized responses,
  context recursion).
- Local file or stream-wrapper access through crafted URLs.
- XML external entity (XXE) processing while parsing HTML.

The library deliberately never guesses whether a string is a document, a path or a URL,
and never fetches anything on your behalf unless you explicitly configure it to. Reports
that rely on disabling these protections (for instance, passing an attacker-controlled URL
straight to your own HTTP client) describe an application-level issue rather than a
vulnerability in this library.
