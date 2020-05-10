<?php declare(strict_types = 1);
namespace PharIo\GnuPG;

class ErrorStrings {

    // Map generated via makeErrorCodeMap.sh
    private const map = [
        0 => "Success",
        1 => "General error",
        2 => "Unknown packet",
        3 => "Unknown version in packet",
        4 => "Invalid public key algorithm",
        5 => "Invalid digest algorithm",
        6 => "Bad public key",
        7 => "Bad secret key",
        8 => "Bad signature",
        9 => "No public key",
        10 => "Checksum error",
        11 => "Bad passphrase",
        12 => "Invalid cipher algorithm",
        13 => "Cannot open keyring",
        14 => "Invalid packet",
        15 => "Invalid armor",
        16 => "No user ID",
        17 => "No secret key",
        18 => "Wrong secret key used",
        19 => "Bad session key",
        20 => "Unknown compression algorithm",
        21 => "Number is not prime",
        22 => "Invalid encoding method",
        23 => "Invalid encryption scheme",
        24 => "Invalid signature scheme",
        25 => "Invalid attribute",
        26 => "No value",
        27 => "Not found",
        28 => "Value not found",
        29 => "Syntax error",
        30 => "Bad MPI value",
        31 => "Invalid passphrase",
        32 => "Invalid signature class",
        33 => "Resources exhausted",
        34 => "Invalid keyring",
        35 => "Trust DB error",
        36 => "Bad certificate",
        37 => "Invalid user ID",
        38 => "Unexpected error",
        39 => "Time conflict",
        40 => "Keyserver error",
        41 => "Wrong public key algorithm",
        42 => "Tribute to D. A.",
        43 => "Weak encryption key",
        44 => "Invalid key length",
        45 => "Invalid argument",
        46 => "Syntax error in URI",
        47 => "Invalid URI",
        48 => "Network error",
        49 => "Unknown host",
        50 => "Selftest failed",
        51 => "Data not encrypted",
        52 => "Data not processed",
        53 => "Unusable public key",
        54 => "Unusable secret key",
        55 => "Invalid value",
        56 => "Bad certificate chain",
        57 => "Missing certificate",
        58 => "No data",
        59 => "Bug",
        60 => "Not supported",
        61 => "Invalid operation code",
        62 => "Timeout",
        63 => "Internal error",
        64 => "EOF (gcrypt)",
        65 => "Invalid object",
        66 => "Provided object is too short",
        67 => "Provided object is too large",
        68 => "Missing item in object",
        69 => "Not implemented",
        70 => "Conflicting use",
        71 => "Invalid cipher mode",
        72 => "Invalid flag",
        73 => "Invalid handle",
        74 => "Result truncated",
        75 => "Incomplete line",
        76 => "Invalid response",
        77 => "No agent running",
        78 => "Agent error",
        79 => "Invalid data",
        80 => "Unspecific Assuan server fault",
        81 => "General Assuan error",
        82 => "Invalid session key",
        83 => "Invalid S-expression",
        84 => "Unsupported algorithm",
        85 => "No pinentry",
        86 => "pinentry error",
        87 => "Bad PIN",
        88 => "Invalid name",
        89 => "Bad data",
        90 => "Invalid parameter",
        91 => "Wrong card",
        92 => "No dirmngr",
        93 => "dirmngr error",
        94 => "Certificate revoked",
        95 => "No CRL known",
        96 => "CRL too old",
        97 => "Line too long",
        98 => "Not trusted",
        99 => "Operation cancelled",
        100 => "Bad CA certificate",
        101 => "Certificate expired",
        102 => "Certificate too young",
        103 => "Unsupported certificate",
        104 => "Unknown S-expression",
        105 => "Unsupported protection",
        106 => "Corrupted protection",
        107 => "Ambiguous name",
        108 => "Card error",
        109 => "Card reset required",
        110 => "Card removed",
        111 => "Invalid card",
        112 => "Card not present",
        113 => "No PKCS15 application",
        114 => "Not confirmed",
        115 => "Configuration error",
        116 => "No policy match",
        117 => "Invalid index",
        118 => "Invalid ID",
        119 => "No SmartCard daemon",
        120 => "SmartCard daemon error",
        121 => "Unsupported protocol",
        122 => "Bad PIN method",
        123 => "Card not initialized",
        124 => "Unsupported operation",
        125 => "Wrong key usage",
        126 => "Nothing found",
        127 => "Wrong blob type",
        128 => "Missing value",
        129 => "Hardware problem",
        130 => "PIN blocked",
        131 => "Conditions of use not satisfied",
        132 => "PINs are not synced",
        133 => "Invalid CRL",
        134 => "BER error",
        135 => "Invalid BER",
        136 => "Element not found",
        137 => "Identifier not found",
        138 => "Invalid tag",
        139 => "Invalid length",
        140 => "Invalid key info",
        141 => "Unexpected tag",
        142 => "Not DER encoded",
        143 => "No CMS object",
        144 => "Invalid CMS object",
        145 => "Unknown CMS object",
        146 => "Unsupported CMS object",
        147 => "Unsupported encoding",
        148 => "Unsupported CMS version",
        149 => "Unknown algorithm",
        150 => "Invalid crypto engine",
        151 => "Public key not trusted",
        152 => "Decryption failed",
        153 => "Key expired",
        154 => "Signature expired",
        155 => "Encoding problem",
        156 => "Invalid state",
        157 => "Duplicated value",
        158 => "Missing action",
        159 => "ASN.1 module not found",
        160 => "Invalid OID string",
        161 => "Invalid time",
        162 => "Invalid CRL object",
        163 => "Unsupported CRL version",
        164 => "Invalid certificate object",
        165 => "Unknown name",
        166 => "A locale function failed",
        167 => "Not locked",
        168 => "Protocol violation",
        169 => "Invalid MAC",
        170 => "Invalid request",
        171 => "Unknown extension",
        172 => "Unknown critical extension",
        173 => "Locked",
        174 => "Unknown option",
        175 => "Unknown command",
        176 => "Not operational",
        177 => "No passphrase given",
        178 => "No PIN given",
        179 => "Not enabled",
        180 => "No crypto engine",
        181 => "Missing key",
        182 => "Too many objects",
        183 => "Limit reached",
        184 => "Not initialized",
        185 => "Missing issuer certificate",
        186 => "No keyserver available",
        187 => "Invalid elliptic curve",
        188 => "Unknown elliptic curve",
        189 => "Duplicated key",
        190 => "Ambiguous result",
        191 => "No crypto context",
        192 => "Wrong crypto context",
        193 => "Bad crypto context",
        194 => "Conflict in the crypto context",
        195 => "Broken public key",
        196 => "Broken secret key",
        197 => "Invalid MAC algorithm",
        198 => "Operation fully cancelled",
        199 => "Operation not yet finished",
        200 => "Buffer too short",
        201 => "Invalid length specifier in S-expression",
        202 => "String too long in S-expression",
        203 => "Unmatched parentheses in S-expression",
        204 => "S-expression not canonical",
        205 => "Bad character in S-expression",
        206 => "Bad quotation in S-expression",
        207 => "Zero prefix in S-expression",
        208 => "Nested display hints in S-expression",
        209 => "Unmatched display hints",
        210 => "Unexpected reserved punctuation in S-expression",
        211 => "Bad hexadecimal character in S-expression",
        212 => "Odd hexadecimal numbers in S-expression",
        213 => "Bad octal character in S-expression",
        217 => "All subkeys are expired or revoked",
        218 => "Database is corrupted",
        219 => "Server indicated a failure",
        220 => "No name",
        221 => "No key",
        222 => "Legacy key",
        223 => "Request too short",
        224 => "Request too long",
        225 => "Object is in termination state",
        226 => "No certificate chain",
        227 => "Certificate is too large",
        228 => "Invalid record",
        229 => "The MAC does not verify",
        230 => "Unexpected message",
        231 => "Compression or decompression failed",
        232 => "A counter would wrap",
        233 => "Fatal alert message received",
        234 => "No cipher algorithm",
        235 => "Missing client certificate",
        236 => "Close notification received",
        237 => "Ticket expired",
        238 => "Bad ticket",
        239 => "Unknown identity",
        240 => "Bad certificate message in handshake",
        241 => "Bad certificate request message in handshake",
        242 => "Bad certificate verify message in handshake",
        243 => "Bad change cipher message in handshake",
        244 => "Bad client hello message in handshake",
        245 => "Bad server hello message in handshake",
        246 => "Bad server hello done message in handshake",
        247 => "Bad finished message in handshake",
        248 => "Bad server key exchange message in handshake",
        249 => "Bad client key exchange message in handshake",
        250 => "Bogus string",
        251 => "Forbidden",
        252 => "Key disabled",
        253 => "Not possible with a card based key",
        254 => "Invalid lock object",
        255 => "True",
        256 => "False",
        257 => "General IPC error",
        258 => "IPC accept call failed",
        259 => "IPC connect call failed",
        260 => "Invalid IPC response",
        261 => "Invalid value passed to IPC",
        262 => "Incomplete line passed to IPC",
        263 => "Line passed to IPC too long",
        264 => "Nested IPC commands",
        265 => "No data callback in IPC",
        266 => "No inquire callback in IPC",
        267 => "Not an IPC server",
        268 => "Not an IPC client",
        269 => "Problem starting IPC server",
        270 => "IPC read error",
        271 => "IPC write error",
        273 => "Too much data for IPC layer",
        274 => "Unexpected IPC command",
        275 => "Unknown IPC command",
        276 => "IPC syntax error",
        277 => "IPC call has been cancelled",
        278 => "No input source for IPC",
        279 => "No output source for IPC",
        280 => "IPC parameter error",
        281 => "Unknown IPC inquire",
        300 => "Crypto engine too old",
        301 => "Screen or window too small",
        302 => "Screen or window too large",
        303 => "Required environment variable not set",
        304 => "User ID already exists",
        305 => "Name already exists",
        306 => "Duplicated name",
        307 => "Object is too young",
        308 => "Object is too old",
        309 => "Unknown flag",
        310 => "Invalid execution order",
        311 => "Already fetched",
        312 => "Try again later",
        313 => "Wrong name",
        314 => "Not authenticated",
        315 => "Bad authentication",
        316 => "No Keybox daemon running",
        317 => "Keybox daemon error",
        318 => "Service is not running",
        319 => "Service error",
        666 => "System bug detected",
        711 => "Unknown DNS error",
        712 => "Invalid DNS section",
        713 => "Invalid textual address form",
        714 => "Missing DNS query packet",
        715 => "Missing DNS answer packet",
        716 => "Connection closed in DNS",
        717 => "Verification failed in DNS",
        718 => "DNS Timeout",
        721 => "General LDAP error",
        722 => "General LDAP attribute error",
        723 => "General LDAP name error",
        724 => "General LDAP security error",
        725 => "General LDAP service error",
        726 => "General LDAP update error",
        727 => "Experimental LDAP error code",
        728 => "Private LDAP error code",
        729 => "Other general LDAP error",
        750 => "LDAP connecting failed (X)",
        751 => "LDAP referral limit exceeded",
        752 => "LDAP client loop",
        754 => "No LDAP results returned",
        755 => "LDAP control not found",
        756 => "Not supported by LDAP",
        757 => "LDAP connect error",
        758 => "Out of memory in LDAP",
        759 => "Bad parameter to an LDAP routine",
        760 => "User cancelled LDAP operation",
        761 => "Bad LDAP search filter",
        762 => "Unknown LDAP authentication method",
        763 => "Timeout in LDAP",
        764 => "LDAP decoding error",
        765 => "LDAP encoding error",
        766 => "LDAP local error",
        767 => "Cannot contact LDAP server",
        768 => "LDAP success",
        769 => "LDAP operations error",
        770 => "LDAP protocol error",
        771 => "Time limit exceeded in LDAP",
        772 => "Size limit exceeded in LDAP",
        773 => "LDAP compare false",
        774 => "LDAP compare true",
        775 => "LDAP authentication method not supported",
        776 => "Strong(er) LDAP authentication required",
        777 => "Partial LDAP results+referral received",
        778 => "LDAP referral",
        779 => "Administrative LDAP limit exceeded",
        780 => "Critical LDAP extension is unavailable",
        781 => "Confidentiality required by LDAP",
        782 => "LDAP SASL bind in progress",
        784 => "No such LDAP attribute",
        785 => "Undefined LDAP attribute type",
        786 => "Inappropriate matching in LDAP",
        787 => "Constraint violation in LDAP",
        788 => "LDAP type or value exists",
        789 => "Invalid syntax in LDAP",
        800 => "No such LDAP object",
        801 => "LDAP alias problem",
        802 => "Invalid DN syntax in LDAP",
        803 => "LDAP entry is a leaf",
        804 => "LDAP alias dereferencing problem",
        815 => "LDAP proxy authorization failure (X)",
        816 => "Inappropriate LDAP authentication",
        817 => "Invalid LDAP credentials",
        818 => "Insufficient access for LDAP",
        819 => "LDAP server is busy",
        820 => "LDAP server is unavailable",
        821 => "LDAP server is unwilling to perform",
        822 => "Loop detected by LDAP",
        832 => "LDAP naming violation",
        833 => "LDAP object class violation",
        834 => "LDAP operation not allowed on non-leaf",
        835 => "LDAP operation not allowed on RDN",
        836 => "Already exists (LDAP)",
        837 => "Cannot modify LDAP object class",
        838 => "LDAP results too large",
        839 => "LDAP operation affects multiple DSAs",
        844 => "Virtual LDAP list view error",
        848 => "Other LDAP error",
        881 => "Resources exhausted in LCUP",
        882 => "Security violation in LCUP",
        883 => "Invalid data in LCUP",
        884 => "Unsupported scheme in LCUP",
        885 => "Reload required in LCUP",
        886 => "LDAP cancelled",
        887 => "No LDAP operation to cancel",
        888 => "Too late to cancel LDAP",
        889 => "Cannot cancel LDAP",
        890 => "LDAP assertion failed",
        891 => "Proxied authorization denied by LDAP",
        1024 => "User defined error code 1",
        1025 => "User defined error code 2",
        1026 => "User defined error code 3",
        1027 => "User defined error code 4",
        1028 => "User defined error code 5",
        1029 => "User defined error code 6",
        1030 => "User defined error code 7",
        1031 => "User defined error code 8",
        1032 => "User defined error code 9",
        1033 => "User defined error code 10",
        1034 => "User defined error code 11",
        1035 => "User defined error code 12",
        1036 => "User defined error code 13",
        1037 => "User defined error code 14",
        1038 => "User defined error code 15",
        1039 => "User defined error code 16",
        1500 => "SQL success",
        1501 => "SQL error",
        1502 => "Internal logic error in SQL library",
        1503 => "Access permission denied (SQL)",
        1504 => "SQL abort was requested",
        1505 => "SQL database file is locked",
        1506 => "An SQL table in the database is locked",
        1507 => "SQL library ran out of core",
        1508 => "Attempt to write a readonly SQL database",
        1509 => "SQL operation terminated by interrupt",
        1510 => "I/O error during SQL operation",
        1511 => "SQL database disk image is malformed",
        1512 => "Unknown opcode in SQL file control",
        1513 => "Insertion failed because SQL database is full",
        1514 => "Unable to open the SQL database file",
        1515 => "SQL database lock protocol error",
        1516 => "(internal SQL code: empty)",
        1517 => "SQL database schema changed",
        1518 => "String or blob exceeds size limit (SQL)",
        1519 => "SQL abort due to constraint violation",
        1520 => "Data type mismatch (SQL)",
        1521 => "SQL library used incorrectly",
        1522 => "SQL library uses unsupported OS features",
        1523 => "Authorization denied (SQL)",
        1524 => "(unused SQL code: format)",
        1525 => "SQL bind parameter out of range",
        1526 => "File opened that is not an SQL database file",
        1527 => "Notifications from SQL logger",
        1528 => "Warnings from SQL logger",
        1600 => "SQL has another row ready",
        1601 => "SQL has finished executing",
        16381 => "System error w/o errno",
        16382 => "Unknown system error",
        16383 => "End of file"
    ];

    public static function fromCode(int $code): string {
        if (!isset(self::map[$code])) {
            return 'unknown error code';
        }

        return self::map[$code];
    }
}