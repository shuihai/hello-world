def get_counts(sequence):
    counts = {}
    for x in sequence:
        if x in counts:
            counts[x] += 1
        else:
            counts[x] = 1
    return counts


def test():
    import json
    path = 'usagov_bitly_data2012-03-16-1331923249.txt'
    records = [json.loads(line) for line in open(path)]
    time_zones=[rec['tz'] for rec in records if 'tz' in rec]
    counts = get_counts(time_zones)
    value_key_pairs= [(count, tz) for tz, count in counts.items()]
    value_key_pairs.sort()
    print value_key_pairs[-10:]
    from collections import Counter
    counts =Counter(time_zones)
    counts.most_common(-10)
    print counts.most_common(10)

test()