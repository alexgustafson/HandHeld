//
//  HHFieldModel.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 16.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "HHFieldModel.h"

@implementation HHFieldModel
@synthesize children;
@synthesize id;
@synthesize order_nr;
@synthesize fieldType;
@synthesize fieldTypeName;
@synthesize name;
@synthesize data;

- (UIColor *) colorFromHexString:(NSString *)hexString {
    NSString *cleanString = [hexString stringByReplacingOccurrencesOfString:@"#" withString:@""];
    if([cleanString length] == 3) {
        cleanString = [NSString stringWithFormat:@"%@%@%@%@%@%@",
                       [cleanString substringWithRange:NSMakeRange(0, 1)],[cleanString substringWithRange:NSMakeRange(0, 1)],
                       [cleanString substringWithRange:NSMakeRange(1, 1)],[cleanString substringWithRange:NSMakeRange(1, 1)],
                       [cleanString substringWithRange:NSMakeRange(2, 1)],[cleanString substringWithRange:NSMakeRange(2, 1)]];
    }
    if([cleanString length] == 6) {
        cleanString = [cleanString stringByAppendingString:@"ff"];
    }
    
    unsigned int baseValue;
    [[NSScanner scannerWithString:cleanString] scanHexInt:&baseValue];
    
    float red = ((baseValue >> 24) & 0xFF)/255.0f;
    float green = ((baseValue >> 16) & 0xFF)/255.0f;
    float blue = ((baseValue >> 8) & 0xFF)/255.0f;
    float alpha = ((baseValue >> 0) & 0xFF)/255.0f;
    
    return [UIColor colorWithRed:red green:green blue:blue alpha:alpha];
}

-(UIImage *)getImageForResource
{

    NSArray *pathArr = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *folder = [pathArr objectAtIndex:0];
    NSString *filePath = [folder stringByAppendingPathComponent:data];
    return [UIImage imageWithContentsOfFile:filePath];
}

-(UIColor *)getColor
{
    return [self colorFromHexString:data];
}


@end
